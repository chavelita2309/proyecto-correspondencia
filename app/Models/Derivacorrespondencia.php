<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Derivacorrespondencia extends Model
{
    use HasFactory;
    protected $table = 'derivacorrespondencias';
    protected $fillable = ['fecha', 'prioridad', 'estado', 'observaciones', 'correspondencia_id', 'funcionario_id', 'fecha_recepcion', 'fecha_conclusion'];

    // fechas se manejen como objetos Carbon
    protected $casts = [
        'fecha' => 'date', // 'fecha' es DATE en la migración
        'fecha_recepcion' => 'datetime', // 'fecha_recepcion' es TIMESTAMP en la migración
        'fecha_conclusion' => 'datetime', // 'fecha_conclusion' es TIMESTAMP en la migración
    ];

    public function correspondencia()
    {
        return $this->belongsTo(Correspondencia::class, 'correspondencia_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'derivacion_id');
    }

    // calcular los días de retencion desde la recepcion
    public function getDiasDesdeRecepcionAttribute()
    {
        if ($this->fecha_recepcion) {
            return Carbon::parse($this->fecha_recepcion)->diffInDays(Carbon::now());
        }
        return null;
    }

    public function funcionarioActual()
    {
        return $this->derivaciones()->whereNull('fecha_conclusion')->latest()->first()?->funcionario;
    }

    // App\Models\Derivacorrespondencia.php

    public function getDiasRetencionAttribute()
    {
        $inicio = $this->fecha->copy()->startOfDay();
        $fin = now()->startOfDay();

        // Lista de feriados locales 
        $feriados = collect([
            '2025-01-01',
            '2025-01-22',
            '2025-04-18',
            '2025-05-01',
            '2025-06-19',
            '2025-06-21',
            '2025-07-16',
            '2025-11-02',
            '2025-12-25',
          
        ])->map(fn($fecha) => \Carbon\Carbon::parse($fecha));

        $dias = 0;
        while ($inicio->lt($fin)) {
            if (!$inicio->isWeekend() && !$feriados->contains(fn($f) => $f->equalTo($inicio))) {
                $dias++;
            }
            $inicio->addDay();
        }

        return $dias;
    }

    public function getColorAlertaAttribute()
{
    $dias = $this->dias_retencion;

    if ($dias > 7) return 'bg-red-200';
    if ($dias > 2) return 'bg-yellow-200';
    return '';
}

}
