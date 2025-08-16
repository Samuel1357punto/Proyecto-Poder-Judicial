<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['nombre'];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}


