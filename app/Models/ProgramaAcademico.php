<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaAcademico extends Model
{
    protected $table = 'programas_academicos';
    protected $primaryKey = 'id_programa';
    public $timestamps = false;

    protected $fillable = [
        'id_facultad',
        'nombre',
        'codigo',
        'estado',
    ];
}