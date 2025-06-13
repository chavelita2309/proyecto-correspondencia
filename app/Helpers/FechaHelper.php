<?php

namespace App\Helpers;

use Carbon\Carbon;

class FechaHelper
{
    public static function calcularDiasHabiles(Carbon $inicio, Carbon $fin)
    {
        $feriados = [
            '2025-01-01',
            '2025-01-22',
            '2025-04-18',
            '2025-05-01',
            '2025-06-19',
            '2025-06-21',
            '2025-07-16',
            '2025-11-02',
            '2025-12-25',
        ];

        $diasHabiles = 0;
        $fecha = $inicio->copy();

        while ($fecha->lte($fin)) {
            if (!$fecha->isWeekend() && !in_array($fecha->format('Y-m-d'), $feriados)) {
                $diasHabiles++;
            }
            $fecha->addDay();
        }

        return max(0, $diasHabiles - 1); // Asegura que no haya negativos
    }

    // 🔧 Este es el método que falta y que debes agregar:
    public static function diasHabilesTranscurridos($fechaInicio)
    {
        $inicio = Carbon::parse($fechaInicio);
        $fin = Carbon::now();
        return self::calcularDiasHabiles($inicio, $fin);
    }
}

