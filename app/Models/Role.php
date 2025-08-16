<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Obtener los usuarios que tienen este rol
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Verificar si el rol es administrador
     */
    public function isAdmin()
    {
        return $this->name === 'administrador';
    }

    /**
     * Verificar si el rol es usuario normal
     */
    public function isUser()
    {
        return $this->name === 'usuario';
    }
}