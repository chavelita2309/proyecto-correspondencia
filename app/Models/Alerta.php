<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = [
        'correspondencia_id',
        'funcionario_id',
        'tipo',
        'vista',
        'fecha_alerta',
        'mensaje',
    ];

    public function correspondencia()
    {
        return $this->belongsTo(Correspondencia::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}