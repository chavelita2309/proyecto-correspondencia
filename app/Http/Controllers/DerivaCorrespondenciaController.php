<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DerivaCorrespondencia;
use App\Models\Correspondencia;
use App\Models\Funcionario;
use App\Models\Seguimiento;
use Carbon\Carbon;


class DerivaCorrespondenciaController extends Controller
{
    public function index($id)
    {
        $correspondencia = Correspondencia::findOrFail($id);
        $funcionarios = Funcionario::all(); // Obtener todos los funcionarios

        return view('Derivacion.index', compact('correspondencia', 'funcionarios'));
    }

    public function store(Request $request, $id)
    {
        //  Validar datos
        $request->validate([
            'fecha' => 'required|date',
            'prioridad' => 'required|in:alta,regular,baja',
            'observaciones' => 'nullable|string',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);

        // Actualizar la derivación actual (la que deriva el trámite) a 'derivado'
        $derivacionActual = DerivaCorrespondencia::where('correspondencia_id', $id)
            ->where('estado', 'recibido') // solo si estaba recibido
            ->where('funcionario_id', auth()->user()->funcionario->id)
            ->latest('fecha')
            ->first();

        if ($derivacionActual) {
            $derivacionActual->estado = 'en revision';
            $derivacionActual->save();
        }

        // Crear nueva derivación
        $derivacion = DerivaCorrespondencia::create([
            'fecha' => $request->fecha,
            'prioridad' => $request->prioridad,
            'estado' => 'en revision',
            'observaciones' => $request->observaciones,
            'correspondencia_id' => $id,
            'funcionario_id' => $request->funcionario_id,
            'fecha_recepcion' => null,
            'fecha_conclusion' => null,
        ]);

        // Registrar en seguimiento
        Seguimiento::create([
            'accion' => 'Derivación',
            'comentario' => $request->observaciones ?? 'Correspondencia derivada.',
            'fecha' => $request->fecha,
            'correspondencia_id' => $id,
            'funcionario_id' => $request->funcionario_id,
        ]);

        return redirect()->route('derivacion.index', $id)
            ->with('mensaje', 'Correspondencia derivada correctamente.');
    }




    public function verTramite(Request $request, $id)
    {
        $derivacion = DerivaCorrespondencia::findOrFail($id);

        // Si la fecha de recepción es NULL, la registramos y actualizamos el estado de la derivación
        if (is_null($derivacion->fecha_recepcion)) {
            $derivacion->update([
                'fecha_recepcion' => Carbon::parse($request->fecha_recepcion),
                'estado' => 'recibido', // Marcar la derivación como 'recibido'
            ]);

            // Actualizar el estado de la correspondencia principal si estaba en 'registrado'
            $correspondencia = $derivacion->correspondencia;
            if ($correspondencia && $correspondencia->estado === 'registrado') {
                $correspondencia->update(['estado' => 'en_proceso']);
            }
        }

        return view('tramites.ver', compact('derivacion'));
    }

    public function recibir(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'nullable|string|max:1000',
        ]);

        $derivacion = DerivaCorrespondencia::findOrFail($id);

        // Solo actualizar si la derivación no ha sido recibida o está en un estado anterior
        if (is_null($derivacion->fecha_recepcion) || $derivacion->estado === 'en revision') {
            $derivacion->estado = 'recibido'; // Cambiar a 'recibido'
            $derivacion->fecha_recepcion = $request->fecha_recepcion;
            $derivacion->save();

            // Actualizar el estado de la correspondencia principal si estaba en 'registrado'
            $correspondencia = $derivacion->correspondencia;
            if ($correspondencia && $correspondencia->estado === 'registrado') {
                $correspondencia->update(['estado' => 'en_proceso']);
            }

            Seguimiento::create([
                'accion' => 'Recibido',
                'comentario' => $request->comentario ?? 'El funcionario recibió la correspondencia.',
                'fecha' => $request->fecha,
                'correspondencia_id' => $derivacion->correspondencia_id,
                'funcionario_id' => $derivacion->funcionario_id,
            ]);

            return back()->with('mensaje', 'Trámite marcado como recibido.');
        }

        return back()->with('error', 'El trámite ya ha sido recibido o está en un estado posterior.');
    }

    public function concluir(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'nullable|string|max:1000',
        ]);

        $derivacion = DerivaCorrespondencia::findOrFail($id);

        // Solo permitir concluir si no está ya concluido
        if ($derivacion->estado !== 'concluido') {
            $derivacion->estado = 'concluido';
            $derivacion->fecha_conclusion = now();
            $derivacion->save();

            Seguimiento::create([
                'accion' => 'Concluido',
                'comentario' => $request->comentario ?? 'El funcionario concluyó el trámite.',
                'fecha' => now(),
                'correspondencia_id' => $derivacion->correspondencia_id,
                'funcionario_id' => $derivacion->funcionario_id,
            ]);

            // Lógica para actualizar el estado de la Correspondencia principal
            $correspondencia = $derivacion->correspondencia;
            if ($correspondencia) {
                // Comprobar si TODAS las derivaciones de esta correspondencia están concluidas
                $todasConcluidas = $correspondencia->derivaciones->every(function ($deriv) {
                    return $deriv->estado === 'concluido';
                });

                if ($todasConcluidas) {
                    $correspondencia->update(['estado' => 'concluido']);
                }
            }

            return back()->with('mensaje', 'Trámite concluido correctamente.');
        }

        return back()->with('error', 'El trámite ya se encuentra concluido.');
    }
}
