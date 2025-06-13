<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;


class Correspondencia extends Model
{
    use HasFactory;

    protected $table = 'correspondencias';

    protected $fillable = [
        'rut',
        'tipo_registro',
        'fecha',
        'hora',
        'gestion',
        'fojas',
        'folder',
        'destinatario',
        'unidad',
        'referencia',
        'remitente',
        'fono',
        'tipo',
        'estado',
        'codigo',
        'documento'
    ];

    protected $casts = [
        'fecha' => 'date', // Asegura que 'fecha' sea un objeto Carbon
        'hora' => 'datetime', // Si 'hora' es un string 'HH:MM:SS', esto lo convierte a Carbon con fecha de hoy
    ];

    // Lista de tipos de correspondencia predefinidos
    public static function tiposPredefinidos()
    {
        return ['instructivo', 'circular', 'nota interna', 'nota externa', 'comunicado', 'invitacion', 'citacion', 'informe'];
    }

    // ✅ Evento al crear y guardar la correspondencia
    protected static function booted()
    {
        static::creating(function ($correspondencia) {
            $correspondencia->codigo = Str::random(6); // Código aleatorio
            // Establecer el estado inicial si no se ha definido explícitamente
            if (is_null($correspondencia->estado)) {
                $correspondencia->estado = 'registrado';
            }
        });

        static::saving(function ($correspondencia) {
            if ($correspondencia->fecha) {
                $correspondencia->gestion = date('Y', strtotime($correspondencia->fecha)); // Año de la fecha
            }
        });
    }

    // ✅ Generador de código aleatorio único
    private static function generarCodigoUnico()
    {
        do {
            $codigo = Str::upper(Str::random(6)); // Mayúsculas para mayor uniformidad
        } while (self::where('codigo', $codigo)->exists());

        return $codigo;
    }

    // ✅ Relación con la unidad
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function derivaciones()
    {
        return $this->hasMany(Derivacorrespondencia::class, 'correspondencia_id')->orderBy('created_at', 'asc');
    }
    public function funcionarioActual()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }
}
