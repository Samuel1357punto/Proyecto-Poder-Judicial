<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permanencia extends Model
{
    protected $fillable = [
        'numero_empleado',
        'nombre_juez',
        'adscripcion',
        'fecha',
        'permanencia',
        'observacion',
    ];
}
