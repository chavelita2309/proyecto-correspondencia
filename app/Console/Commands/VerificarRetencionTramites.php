<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Correspondencia; // Necesario para la alerta de no recepción inicial
use App\Models\Derivacorrespondencia;
use App\Models\Alerta;
use App\Models\User; // Asumiendo que el director es un usuario

use App\Mail\AlertaRetencion; // Usaremos este Mailable para el director
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class VerificarRetencionTramites extends Command
{
    /**
     * El nombre y la firma del comando de consola.
     *
     * @var string
     */
    protected $signature = 'alertas:verificar-retencion'; 

    /**
     * La descripción del comando de consola.
     *
     * @var string
     */
    protected $description = 'Verifica trámites para generar alertas (no recepción, retraso amarillo, retraso rojo) y enviar correos.';

    /**
     * Ejecuta el comando de consola.
     */
    public function handle()
    {
        
        
        $this->info('Iniciando verificación de alertas de trámites...');

        // 1. Verificar correspondencias no recibidas y enviar email al director (Alerta de 48 horas)
        $this->checkInitialUnreceivedCorrespondences();

        // 2. Verificar derivaciones pendientes para alertas amarilla y roja (Alerta de 7 días / >7 días)
        $this->checkOverdueDerivations();

        $this->info('Verificación de alertas de trámites completada.');
    }

    /**
     * Verifica correspondencias que no han sido recibidas y envía un correo al director.
     * Alerta: Si un trámite no se atiende (no tiene ninguna derivación con estado 'recibido') después de 48 horas.
     */
    protected function checkInitialUnreceivedCorrespondences()
    {
        // Encontrar correspondencias que fueron registradas hace más de 48 horas (2 días)
        // y que aún están en estado 'registrado' (no han sido atendidas/recibidas en ninguna derivación)
        $unreceivedCorrespondences = Correspondencia::where('created_at', '<', Carbon::now()->subHours(48))
            ->where('estado', 'registrado') // Estado inicial de la correspondencia
            ->get();

        foreach ($unreceivedCorrespondences as $correspondencia) {
            // Verificar si ya existe una alerta de email de no recepción para esta correspondencia
            // y si fue creada hace menos de 24 horas (para no enviar emails cada hora)
            $existingEmailAlert = Alerta::where('correspondencia_id', $correspondencia->id)
                                        ->where('tipo', 'email_no_recepcion')
                                        ->where('created_at', '>', Carbon::now()->subHours(23)) // Evitar spam de correos
                                        ->first();

            if (!$existingEmailAlert) {
                $mensaje = "El trámite con código " . $correspondencia->codigo_seguimiento . " no ha sido recibido por ningún funcionario después de 48 horas de su registro. Asunto: " . $correspondencia->asunto;

                // Crear alerta en la base de datos
                Alerta::create([
                    'correspondencia_id' => $correspondencia->id,
                    'tipo' => 'email_no_recepcion',
                    'fecha_alerta' => Carbon::now(),
                    'mensaje' => $mensaje,
                    'vista' => false,
                    'funcionario_id' => null, // No hay funcionario específico responsable de la no-recepción inicial
                ]);

                // Enviar correo al director
                // Se asume que el modelo User utiliza el trait HasRoles (ej. de Spatie/laravel-permission)
                // y que el rol 'director' existe en tu tabla 'roles'.
                $director = User::role('director')->first(); 
                if ($director) {
                    Mail::to($director->email)->send(new AlertaRetencion($correspondencia, $mensaje));
                    $this->info("Correo de alerta 'no recepción' enviado al director para el trámite: " . $correspondencia->codigo_seguimiento);
                } else {
                    $this->warn("No se encontró un usuario con el rol 'director' para enviar la alerta de no recepción.");
                }
            }
        }
    }

    /**
     * Verifica derivaciones pendientes para generar alertas amarilla y roja.
     * Alerta Amarilla (Sistema): Si un trámite no tiene respuesta (concluido) en 7 días desde su recepción.
     * Alerta Roja (Sistema): Si un trámite no tiene respuesta (concluido) en más de 7 días desde su recepción.
     */
    protected function checkOverdueDerivations()
    {
        // Encontrar derivaciones que han sido recibidas pero no concluidas
        $pendingDerivations = Derivacorrespondencia::where('estado', 'recibido') // Solo las que están en estado 'recibido'
            ->whereNotNull('fecha_recepcion')
            ->whereNull('fecha_conclusion')
            ->with('correspondencia', 'funcionario') // Cargar relaciones para acceder a sus datos
            ->get();

        foreach ($pendingDerivations as $derivacion) {
            // Asegúrate de que la correspondencia y el funcionario existan
            if (!$derivacion->correspondencia || !$derivacion->funcionario) {
                $this->warn("Derivación ID {$derivacion->id} sin correspondencia o funcionario asociado. Saltando.");
                continue;
            }

            $tiempoTranscurridoEnHoras = Carbon::parse($derivacion->fecha_recepcion)->diffInHours(Carbon::now());
            $correspondencia = $derivacion->correspondencia;
            $funcionarioId = $derivacion->funcionario_id;

            // Alerta Amarilla (7 días o más desde recepción, pero no más de 7 días completos)
            // Se activa a partir del día 7 (168 horas) hasta justo antes del día 8 (192 horas)
            if ($tiempoTranscurridoEnHoras >= (7 * 24) && $tiempoTranscurridoEnHoras < (8 * 24)) {
                $tipoAlerta = 'retraso_amarillo';
                $dias = floor($tiempoTranscurridoEnHoras / 24);
                $mensaje = "El trámite con código " . $correspondencia->codigo_seguimiento . " (Asunto: " . $correspondencia->asunto . ") lleva {$dias} días sin concluir desde su recepción. Funcionario: " . $derivacion->funcionario->nombre_completo;

                $this->createOrUpdateAlert($correspondencia->id, $funcionarioId, $tipoAlerta, $mensaje);
                $this->info("Alerta Amarilla generada/actualizada para el trámite: " . $correspondencia->codigo_seguimiento . " (Funcionario: " . $derivacion->funcionario->nombre_completo . ")");

            }
            // Alerta Roja (más de 7 días completos desde recepción, es decir, 8 días o más)
            elseif ($tiempoTranscurridoEnHoras >= (8 * 24)) {
                $tipoAlerta = 'retraso_rojo';
                $dias = floor($tiempoTranscurridoEnHoras / 24);
                $mensaje = "¡ALERTA ROJA! El trámite con código " . $correspondencia->codigo_seguimiento . " (Asunto: " . $correspondencia->asunto . ") lleva más de {$dias} días sin concluir desde su recepción. Funcionario: " . $derivacion->funcionario->nombre_completo;

                $this->createOrUpdateAlert($correspondencia->id, $funcionarioId, $tipoAlerta, $mensaje);
                $this->info("Alerta Roja generada/actualizada para el trámite: " . $correspondencia->codigo_seguimiento . " (Funcionario: " . $derivacion->funcionario->nombre_completo . ")");
            }
        }
    }

    /**
     * Crea o actualiza una alerta en la base de datos.
     *
     * @param int $correspondenciaId
     * @param int|null $funcionarioId
     * @param string $tipoAlerta
     * @param string $mensaje
     */
    protected function createOrUpdateAlert($correspondenciaId, $funcionarioId, $tipoAlerta, $mensaje)
    {
        // Buscar una alerta existente del mismo tipo para esta correspondencia y funcionario
        $existingAlert = Alerta::where('correspondencia_id', $correspondenciaId)
                                ->where('funcionario_id', $funcionarioId)
                                ->where('tipo', $tipoAlerta)
                                ->first();

        if ($existingAlert) {
            // Si ya existe, actualizar solo la fecha y el mensaje
            $existingAlert->update([
                'fecha_alerta' => Carbon::now(),
                'mensaje' => $mensaje,
                'vista' => false, // Opcional: resetear a no vista si se actualiza
            ]);
        } else {
            // Si no existe, crear una nueva alerta
            Alerta::create([
                'correspondencia_id' => $correspondenciaId,
                'funcionario_id' => $funcionarioId,
                'tipo' => $tipoAlerta,
                'fecha_alerta' => Carbon::now(),
                'mensaje' => $mensaje,
                'vista' => false,
            ]);
        }
    }
}
