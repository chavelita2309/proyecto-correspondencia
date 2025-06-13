<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Funcionario;
use App\Models\Derivacorrespondencia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\AlertaRetencionTramite;

class AlertarSuperior implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $diasPermitidos = 3; // Días límite antes de la alerta

        $derivaciones = Derivacorrespondencia::whereNotNull('fecha_recepcion')
            ->whereNull('fecha_conclusion')
            ->whereRaw('DATEDIFF(NOW(), fecha_recepcion) > ?', [$diasPermitidos])
            ->get();

        foreach ($derivaciones as $derivacion) {
            // Obtener el funcionario que tiene el trámite
            $funcionario = Funcionario::find($derivacion->funcionario_id);

            if ($funcionario) {
                // Buscar el Director de Carrera en la misma unidad
                $director = Funcionario::where('unidad_id', $funcionario->unidad_id)
                    ->where('cargo', 'Director de Carrera')
                    ->first();

                if ($director && $director->user->email) {
                    Mail::to($director->user->email)->send(new AlertaRetencionTramite($derivacion));
                    Log::info("Alerta enviada a {$director->user->email} por trámite retenido.");
                }
            }
        }
    }
}
