<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';

    protected $fillable = [
        'id_evaluacion',
        'id_estudiante',
        'nota',
        'observaciones',
    ];
}