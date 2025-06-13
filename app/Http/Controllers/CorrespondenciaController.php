<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Correspondencia;
use App\Models\Funcionario;
use App\Models\Seguimiento;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CorrespondenciaController extends Controller
{
    public function index()
    {
        $cor = Correspondencia::orderby('rut', 'desc')->paginate(10);
        return view('Correspondencia.index', ['correspondencia' => $cor]);
    }

    // ✅ Mostrar formulario de registro
    public function registrar()
    {
        $tiposPredefinidos = Correspondencia::tiposPredefinidos(); // Llamamos los tipos predefinidos del modelo
        return view('Correspondencia.registrar', compact('tiposPredefinidos'));
    }

    // ✅ Guardar una nueva correspondencia
    public function store(Request $request)
    {


        $request->validate([
            'rut' => 'required|string|max:20|unique:correspondencias,rut',
            // 'tipo_registro' => 'required|in:recibida,emitida',
            'fecha' => 'required|date',
            'hora' => 'required',
            'fojas' => 'required|string',
            'folder' => 'nullable|string',
            'destinatario' => 'required|string|max:100',
            'unidad' => 'nullable|string|max:100',
            'referencia' => 'required|string',
            'remitente' => 'required|string|max:100',
            'fono' => 'nullable|string|max:20',
            'tipo' => 'required|string|max:50',
            'documento' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Solo archivos permitidos
        ]);

        // Si el usuario seleccionó "Otro", usamos el valor ingresado
        $tipo = ($request->tipo === 'otro') ? $request->tipo_otro : $request->tipo;

        // Guardar correspondencia
        $correspondencia = new Correspondencia();
        $correspondencia->fill($request->except('tipo', 'tipo_otro'));

        $correspondencia->tipo = $tipo;

        // Guardar el documento si se subió
        if ($request->hasFile('documento')) {
            $archivo = $request->file('documento');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('archivos'), $nombreArchivo);
            $correspondencia->documento = $nombreArchivo;
        }

        $correspondencia->save();

        return redirect()->route('correspondencia.confirmacion', ['id' => $correspondencia->id]);


        // return redirect()->route('correspondencia.index')->with('mensaje', 'Correspondencia registrada correctamente');
    }

    public function confirmacion($id)
    {
        $correspondencia = Correspondencia::findOrFail($id);
        return view('Correspondencia.confirmacion', compact('correspondencia'));
    }

    public function mostrar($id)
    {
        $cor = Correspondencia::findOrFail($id);

        return view('Correspondencia.mostrar', ['correspondencia' => $cor]);
    }

    public function generarHojaIndividual($id)
    {
        // Buscar la correspondencia por su ID.

       $correspondencia = Correspondencia::findOrFail($id);


        // Preparar los datos que se enviarán a la vista Blade.

        $data = [
            'correspondencia' => $correspondencia, // La correspondencia completa
            'university_name' => 'UNIVERSIDAD PÚBLICA DE EL ALTO',
            'department_name' => 'CARRERA DE INGENIERÍA TEXTIL',

            'current_date_formatted' => Carbon::parse($correspondencia->fecha)->format('d \d\e F \d\e Y'),
            'current_time_formatted' => Carbon::parse($correspondencia->hora)->format('H:i'),


        ];


        $pdf = PDF::loadView('reportes.hoja_de_ruta_individual', $data);


        $filename = 'HojaDeRuta_' . $correspondencia->codigo . '.pdf';


        return $pdf->stream($filename);
    }


    // Mostrar detalles de una correspondencia

    //  Mostrar formulario de edición
    public function editar(Correspondencia $correspondencia)
    {
        $tiposPredefinidos = Correspondencia::tiposPredefinidos();
        return view('Correspondencia.editar', compact('correspondencia', 'tiposPredefinidos'));
    }

    // Editar correspondencia
    public function update(Request $request, Correspondencia $correspondencia)
    {
        $request->validate([
            'rut' => 'required|string|max:20|unique:correspondencias,rut,' . $correspondencia->id,
            'tipo_registro' => 'required|in:recibida,emitida',
            'fecha' => 'required|date',
            'hora' => 'required',
            'fojas' => 'required|string',
            'folder' => 'nullable|string',
            'destinatario' => 'required|string|max:100',
            'unidad' => 'nullable|string|max:100',
            'referencia' => 'required|string',
            'remitente' => 'required|string|max:100',
            'fono' => 'nullable|string|max:20',
            'tipo' => 'required|string|max:50',
            'documento' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $tipo = ($request->tipo === 'otro') ? $request->tipo_otro : $request->tipo;
        $correspondencia->fill($request->except('tipo', 'tipo_otro'));
        $correspondencia->tipo = $tipo;

        // Si se sube un nuevo documento, reemplazar el anterior
        if ($request->hasFile('documento')) {
            // Eliminar el documento anterior si existe
            if ($correspondencia->documento && file_exists(public_path('archivos/' . $correspondencia->documento))) {
                unlink(public_path('archivos/' . $correspondencia->documento));
            }

            $archivo = $request->file('documento');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('archivos'), $nombreArchivo);
            $correspondencia->documento = $nombreArchivo;
        }

        $correspondencia->save();

        return redirect()->route('correspondencia.mostrar', $correspondencia->id)
            ->with('mensaje', 'Correspondencia actualizada correctamente');
    }

    // Eliminar correspondencia
    public function borrar($id)
    {
        $cor = Correspondencia::find($id);



        $cor->delete();

        return redirect()->route('correspondencia.index')->with('mensaje', 'Correspondencia eliminada correctamente');
    }
    public function show($id)
    {
        $correspondencia = Correspondencia::with('derivaciones.funcionario')->findOrFail($id);
        $funcionarios = Funcionario::all(); // Obtener todos los funcionarios

        return view('correspondencia.show', compact('correspondencia', 'funcionarios'));
    }

    public function mostrarFormulario()
    {
        return view('tramites.buscar');
    }


    public function buscar(Request $request)
    {
        $codigo = $request->input('codigo');

        $correspondencia = Correspondencia::where('codigo', $codigo)
            ->with(['derivaciones.funcionario'])
            ->first();

        if (!$correspondencia) {
            return redirect()->route('tramites.formulario')->with('error', 'No se encontró el trámite con ese código.');
        }

        // Registrar la búsqueda
        if (auth()->check() && auth()->user()->funcionario) {
            Seguimiento::create([
                'accion' => 'busqueda',
                'comentario' => 'Búsqueda pública del código: ' . $codigo . ' desde IP: ' . $request->ip(),
                'fecha' => now(),
                'correspondencia_id' => $correspondencia->id,
                'funcionario_id' => auth()->user()->funcionario->id,
                'derivacion_id' => null,
            ]);
        }

        $ultimaDerivacion = $correspondencia->derivaciones->last() ?? null;

        // obtener historial de seguimientos
        $seguimientos = Seguimiento::where('correspondencia_id', $correspondencia->id)
            ->where('accion', '!=', 'busqueda')
            ->orderBy('fecha')
            ->get();

        return view('tramites.resultado', compact('correspondencia', 'ultimaDerivacion', 'seguimientos'));
    }





    public function buscarInterno(Request $request)
    {
        $codigo = $request->input('codigo');

        $correspondencia = Correspondencia::where('codigo', $codigo)
            ->with(['derivaciones.funcionario', 'seguimientos'])
            ->first();

        if (!$correspondencia) {
            return redirect()->back()->with('error', 'No se encontró el trámite con ese código.');
        }

        // Solo verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Acceso no autorizado.');
        }

        // Registrar seguimiento
        if (auth()->user()->funcionario) {
            Seguimiento::create([
                'accion' => 'busqueda',
                'comentario' => 'Búsqueda interna del código: ' . $codigo . ' desde IP: ' . $request->ip(),
                'fecha' => now(),
                'correspondencia_id' => $correspondencia->id,
                'funcionario_id' => auth()->user()->funcionario->id,
                'derivacion_id' => null,
            ]);
        }

        return view('tramites.resultado-interno', compact('correspondencia'));
    }


    public function formularioInterno()
    {
        return view('tramites.formulario-interno');
    }
}
