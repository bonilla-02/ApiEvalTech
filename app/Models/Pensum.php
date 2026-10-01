<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    protected $table = 'pensum';

    protected $fillable = [
        'id_programa',
        'codigo',
        'semestres',
    ];
}