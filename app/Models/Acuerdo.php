<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acuerdo extends Model
{
    use HasFactory;

    protected $fillable = [
        'municipio',
        'clave_juzgado',
        'juzgado',
        'materia',
        'acuerdo',
        'juez_id',
        'secretario_id',
        'fecha_limite',
        'fecha_publicacion',
        'estado_tiempo'
    ];

    protected $casts = [
        'fecha_limite' => 'datetime',
        'fecha_publicacion' => 'datetime',
    ];

    /**
     * Relación con el juez
     */
    public function juez()
    {
        return $this->belongsTo(User::class, 'juez_id');
    }

    /**
     * Relación con el secretario
     */
    public function secretario()
    {
        return $this->belongsTo(User::class, 'secretario_id');
    }

    /**
     * Determinar si fue publicado a tiempo
     */
    public function fueATiempo()
    {
        if (!$this->fecha_limite || !$this->fecha_publicacion) {
            return true;
        }
        
        return $this->fecha_publicacion <= $this->fecha_limite;
    }

    /**
     * Actualizar el estado de tiempo
     */
    public function actualizarEstadoTiempo()
    {
        $this->estado_tiempo = $this->fueATiempo() ? 'A_TIEMPO' : 'DESTIEMPO';
        $this->save();
    }
}