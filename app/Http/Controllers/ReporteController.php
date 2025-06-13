<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Correspondencia;
use Barryvdh\DomPDF\Facade\Pdf;


class ReporteController extends Controller
{

    public function menu()
    {
        return view('reportes.menu');
    }


    public function index()
    {
        return view('reportes.index');
    }

    public function generar(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $tipo = $request->input('tipo_registro');
        $gestion = $request->input('gestion');
        $tipo2 = $request->input('tipo');


        $query = Correspondencia::whereBetween('fecha', [$desde, $hasta]);

        if (!empty($tipo)) {
            $query->where('tipo_registro', $tipo);
        }

        if (!empty($gestion)) {
            $query->where('gestion', $gestion);
        }

        if (!empty($tipo2)) {
            $query->where('tipo', $tipo2);
        }


        $correspondencias = $query->orderBy('fecha', 'asc')->get();

        $pdf = \PDF::loadView('reportes.generar', compact('correspondencias', 'desde', 'hasta'));
        return $pdf->stream("reportes_correspondencia_{$desde}_a_{$hasta}.pdf"); //mostrar en el navegador el pdf
    }



    public function libroCorrespondencia()
    {
        return view('reportes.libro_form');
    }

    public function generarLibro(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $tipo = $request->input('tipo_registro');

        $query = Correspondencia::whereBetween('fecha', [$desde, $hasta]);

        if (!empty($tipo)) {
            $query->where('tipo_registro', $tipo);
        }

        $correspondencias = $query->orderBy('rut', 'asc')->get();

        $pdf = \PDF::loadView('reportes.libro', compact('correspondencias', 'desde', 'hasta', 'tipo'))->setPaper('a4', 'landscape');
        return $pdf->stream("libro_correspondencia_{$desde}_a_{$hasta}.pdf");
    }
}
