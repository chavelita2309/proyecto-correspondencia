<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'seguimientos';
    protected $fillable = ['accion', 'comentario', 'fecha', 'correspondencia_id', 'funcionario_id', 'derivacion_id'];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function correspondencia()
    {
        return $this->belongsTo(Correspondencia::class, 'correspondencia_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }
    public function derivacion()
    {
        return $this->belongsTo(DerivaCorrespondencia::class);
    }
}
