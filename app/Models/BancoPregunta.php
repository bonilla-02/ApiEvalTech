<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BancoPregunta extends Model
{
    protected $table = 'banco_preguntas';

    protected $fillable = [
        'id_evaluacion',
        'enunciado',
        'tipo_pregunta',
        'ponderacion',
    ];
}