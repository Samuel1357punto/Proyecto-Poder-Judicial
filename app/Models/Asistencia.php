<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['fecha', 'tipo', 'hora', 'municipio_id', 'empleado'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}

