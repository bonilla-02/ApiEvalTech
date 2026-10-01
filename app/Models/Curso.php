<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'id_asignatura',
        'id_docente',
        'grupo',
        'periodo',
        'estado',
    ];
}