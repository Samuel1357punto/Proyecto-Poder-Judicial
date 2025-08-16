<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role && $this->role->name === 'administrador';
    }

    public function isSecretario()
    {
        return $this->role && $this->role->name === 'secretario';
    }

    public function isJuez()
    {
        return $this->role && $this->role->name === 'juez';
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function getRoleName()
    {
        return $this->role ? $this->role->name : 'sin rol';
    }

    public function getRoleDisplayName()
    {
        $roleNames = [
            'administrador' => 'Administrador del Sistema',
            'secretario' => 'Secretario de Acuerdos',
            'juez' => 'Juez'
        ];
        
        return $roleNames[$this->getRoleName()] ?? 'Usuario';
    }
}