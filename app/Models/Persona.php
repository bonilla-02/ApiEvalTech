<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'edad',
        'correo',
        'documento',
        'estado',
    ];
}