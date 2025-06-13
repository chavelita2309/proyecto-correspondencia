<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios';
    protected $fillable = [
        'nombres',
        'paterno',
        'materno',
        'fecha_designacion',
        'celular',
        'direccion',
        'cargo',
        'estado',
        'unidad_id',
        'user_id'
    ];

    public function unidad()
    {
        return $this->belongsTo('App\Models\Unidad');
    }

    public function user()
    {

        //$user=User::find($this->user_id);
        //return $user;
        return $this->belongsTo('App\Models\User');
    }

    public function derivaciones()
    {
        return $this->hasMany(DerivaCorrespondencia::class, 'funcionario_id');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }

}
