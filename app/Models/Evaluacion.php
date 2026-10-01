<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    // La tabla principal es 'evaluaciones'
    protected $table = 'evaluaciones';
    
    
    protected $fillable = [
        'id_curso',
        'id_tipo_evaluacion',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];
}