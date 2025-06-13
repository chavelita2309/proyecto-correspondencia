<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\DerivaCorrespondencia;
use App\Mail\AlertaRetencion;
use Illuminate\Support\Facades\Mail;

class AlertaController extends Controller
{
    public function verificarRetenciones()
    {
        $derivaciones = DerivaCorrespondencia::where('estado', '!=', 'concluido')
            ->where('fecha', '<=', now()->subHours(48))
            ->get();

        foreach ($derivaciones as $derivacion) {
            // Verifica si ya hay una alerta creada para este caso
            $existeAlerta = Alerta::where('correspondencia_id', $derivacion->correspondencia_id)
                ->where('tipo', 'retraso_conclusion')
                ->exists();

            if (!$existeAlerta) {
                $alerta = Alerta::create([
                    'correspondencia_id' => $derivacion->correspondencia_id,
                    'funcionario_id' => $derivacion->funcionario_id,
                    'tipo' => 'retraso_conclusion',
                    'fecha_alerta' => now(),
                    'mensaje' => 'El funcionario ha retenido el trámite por más de 48 horas.',
                ]);

                // Dirección del director
                $emailDirector = 'directorcarrera@example.com';

                // Enviar correo
                Mail::to($emailDirector)->send(new AlertaRetencion($alerta));
            }
        }

        return back()->with('mensaje', 'Verificación de retención de trámites completada.');
    }
}
