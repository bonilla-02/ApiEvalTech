<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';

    protected $fillable = [
        'id_estudiante',
        'id_curso',
        'promedio',
        'posicion',
    ];
}