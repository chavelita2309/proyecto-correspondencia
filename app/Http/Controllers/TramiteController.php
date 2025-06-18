<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DerivaCorrespondencia;
use App\Models\Correspondencia;
use App\Models\Seguimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\FechaHelper;


class TramiteController extends Controller
{
   public function recibidos()
{
    $subquery = DB::table('derivacorrespondencias')
        ->select(DB::raw('MAX(id) as id'))
        ->groupBy('correspondencia_id');

    $tramites = DerivaCorrespondencia::with(['funcionario', 'correspondencia'])
        ->whereIn('id', $subquery)
        ->where('estado', 'recibido')
        ->paginate(20);

    return view('tramites.recibidos', compact('tramites'));
}

   public function pendientes()
{
    $subquery = DB::table('derivacorrespondencias')
        ->select(DB::raw('MAX(id) as id'))
        ->groupBy('correspondencia_id');

    $tramites = DerivaCorrespondencia::with(['funcionario', 'correspondencia'])
        ->whereIn('id', $subquery)
        ->where('estado', 'en revision')
        ->paginate(20);

    return view('tramites.pendientes', compact('tramites'));
}


    public function despachados()
{
    $subquery = DB::table('derivacorrespondencias')
        ->select(DB::raw('MAX(id) as id'))
        ->groupBy('correspondencia_id');

    $tramites = DerivaCorrespondencia::with(['funcionario', 'correspondencia'])
        ->whereIn('id', $subquery)
        ->where('estado', 'concluido')
        ->paginate(20);

    return view('tramites.despachados', compact('tramites'));
}

    public function buscarPorReferenciaForm()
    {
        return view('tramites.buscar-referencia');
    }

    public function formularioBusquedaReferencia()
    {
        $tipos = Correspondencia::tiposPredefinidos(); // Llama al método estático que define los tipos
        return view('tramites.buscar-referencia', compact('tipos')); // Devuelve la vista con los tipos
    }

    public function buscarPorReferencia(Request $request)
    {
        $query = Correspondencia::query();

        // Búsqueda por palabra clave en la referencia
        if ($request->filled('referencia')) {
            $query->where('referencia', 'LIKE', '%' . $request->referencia . '%');
        }

        // Filtro por gestión (año de creación)
        if ($request->filled('gestion')) {
            $query->whereYear('created_at', $request->gestion);
        }

        // Filtro por tipo predefinido
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $correspondencias = $query->orderBy('created_at', 'desc')->get();

        return view('tramites.resultado-referencia', compact('correspondencias'));
    }

    public function bandejaEntrada()
    {
        $user = auth()->user();
        $cargo = $user->funcionario->cargo;
        $funcionarioId = $user->funcionario->id;

        // Último seguimiento por correspondencia para este funcionario
        $sub = \DB::table('seguimientos')
            ->select('correspondencia_id', \DB::raw('MAX(id) as max_id'))
            ->where('funcionario_id', $user->funcionario->id) //modificado
            ->groupBy('correspondencia_id');

        // Trámites recibidos
        $recibidos = DerivaCorrespondencia::where('estado', 'recibido')
            ->whereHas('funcionario', fn($q) => $q->where('cargo', $cargo))
            ->whereDoesntHave('correspondencia.seguimientos', function ($query) use ($funcionarioId) {
                $query->where('funcionario_id', $funcionarioId)
                    ->where('accion', 'derivado')
                    ->whereColumn('seguimientos.correspondencia_id', 'derivacorrespondencias.correspondencia_id')
                    ->whereColumn('seguimientos.fecha', '>', 'derivacorrespondencias.fecha_recepcion');
            })
            ->with('correspondencia')
            ->orderBy('fecha', 'desc') //
            ->get();

        // Trámites pendientes
        $pendientes = DerivaCorrespondencia::where('estado', 'en revision')
            ->whereHas('funcionario', fn($q) => $q->where('cargo', $cargo))
            ->whereIn('id', function ($subquery) {
                $subquery->select(\DB::raw('MAX(id)'))
                    ->from('derivacorrespondencias')
                    ->groupBy('correspondencia_id');
            })
            ->with('correspondencia')
            ->orderBy('fecha', 'desc') //
            ->get();


        // Trámites concluidos
        $concluidos = DerivaCorrespondencia::where('estado', 'concluido')
            ->whereHas('funcionario', fn($q) => $q->where('cargo', $cargo))
            ->with('correspondencia')
            ->orderBy('fecha', 'desc') //
            ->get();         //

        // return view('tramites.bandeja', compact('recibidos', 'pendientes', 'concluidos'));
        $pendientesCriticos = $pendientes->filter(function ($item) {
            return FechaHelper::diasHabilesTranscurridos($item->fecha) > 7; // más de 7 días hábiles
        })->count();

        $pendientesAdvertencia = $pendientes->filter(function ($item) {
            $dias = FechaHelper::diasHabilesTranscurridos($item->fecha);
            return $dias > 2 && $dias <= 7;
        })->count();

        $recibidosCriticos = $recibidos->filter(function ($item) {
            return $item->fecha_recepcion && FechaHelper::diasHabilesTranscurridos($item->fecha_recepcion) > 7;
        })->count();

        $recibidosAdvertencia = $recibidos->filter(function ($item) {
            if (!$item->fecha_recepcion) return false;
            $dias = FechaHelper::diasHabilesTranscurridos($item->fecha_recepcion);
            return $dias > 2 && $dias <= 7;
        })->count();

        return view('tramites.bandeja', [
            'pendientes' => $pendientes,
            'recibidos' => $recibidos,
            'concluidos' => $concluidos,
            'pendientesCriticos' => $pendientesCriticos,
            'pendientesAdvertencia' => $pendientesAdvertencia,
            'recibidosCriticos' => $recibidosCriticos,
            'recibidosAdvertencia' => $recibidosAdvertencia,
        ]);


//         foreach ($recibidos as $r) {
//     logger("Correspondencia {$r->correspondencia_id} - Fecha recepción: {$r->fecha_recepcion} - Días hábiles: " . FechaHelper::diasHabilesTranscurridos($r->fecha_recepcion));
// }
// foreach ($pendientes as $p) {
//     logger("Correspondencia {$p->correspondencia_id} - Fecha derivación: {$p->fecha} - Días hábiles: " . FechaHelper::diasHabilesTranscurridos($p->fecha));
// }

    }

    public function registrarAccion(Request $request)
    {
        $request->validate([
            'derivacion_id' => 'required|exists:derivacorrespondencias,id',
            'accion' => 'required|in:recibido,en revision,concluido,rechazado',
            'comentario' => 'nullable|string|max:500',
        ]);

        $derivacion = DerivaCorrespondencia::findOrFail($request->derivacion_id);

        // Cambiar estado
        $derivacion->estado = $request->accion;

        // Registrar fecha de recepción si acción es "recibido"
        if ($request->accion === 'recibido' && is_null($derivacion->fecha_recepcion)) {
            $derivacion->fecha_recepcion = now();
        }

        // Registrar fecha de conclusión si acción es "concluido"
        if ($request->accion === 'concluido') {
            $derivacion->fecha_conclusion = now();
        }

        $derivacion->save();

        // Crear seguimiento
        Seguimiento::create([
            'correspondencia_id' => $derivacion->correspondencia_id,
            'funcionario_id' => Auth::user()->funcionario->id,
            'accion' => $request->accion,
            'comentario' => $request->comentario,
            'fecha' => now(),
        ]);

        if ($request->accion === 'derivado') {
            // Crear nueva derivación
            DerivaCorrespondencia::create([
                'fecha' => now(),
                'prioridad' => $derivacion->prioridad,
                'estado' => 'en revision',
                'observaciones' => $request->comentario,
                'correspondencia_id' => $derivacion->correspondencia_id,
                'funcionario_id' => Funcionario::where('cargo_id', $request->cargo_destino_id)->first()->id ?? null,
            ]);

            // Seguimiento
            Seguimiento::create([
                'correspondencia_id' => $derivacion->correspondencia_id,
                'funcionario_id' => $funcionarioId,
                'accion' => 'derivado',
                'comentario' => $request->comentario ?? 'Sin comentario',
                'fecha' => now(),
            ]);
        }

        return redirect()->back()->with('message', 'Acción registrada correctamente.');
    }
}
