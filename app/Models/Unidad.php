<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    protected $fillable = ['nombre', 'descripcion','estado'];

    public function mostrar_funcionarios(){
        return $this->hasmany('App\Models\Funcionario');
    }
}
