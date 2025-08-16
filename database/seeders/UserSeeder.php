<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar que los roles existan
        $adminRole = Role::firstOrCreate(
            ['name' => 'administrador'],
            ['description' => 'Acceso completo al sistema - Gestión de estímulos y evaluación']
        );

        $secretarioRole = Role::firstOrCreate(
            ['name' => 'secretario'],
            ['description' => 'Secretario de Acuerdos - Gestión de acuerdos judiciales']
        );

        $juezRole = Role::firstOrCreate(
            ['name' => 'juez'],
            ['description' => 'Juez - Control de asistencias y permanencias']
        );

        // Crear usuario administrador
        User::create([
            'name' => 'Administrador del Sistema',
            'email' => 'admin@tribunal.gob.mx',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        // Crear secretario de acuerdos
        User::create([
            'name' => 'Juan Pérez García',
            'email' => 'secretario@tribunal.gob.mx',
            'password' => Hash::make('secretario123'),
            'role_id' => $secretarioRole->id,
            'email_verified_at' => now(),
        ]);

        // Crear varios jueces
        $jueces = [
            ['name' => 'Lic. María González López', 'email' => 'juez1@tribunal.gob.mx'],
            ['name' => 'Lic. Carlos Rodríguez Martínez', 'email' => 'juez2@tribunal.gob.mx'],
            ['name' => 'Lic. Ana Hernández Sánchez', 'email' => 'juez3@tribunal.gob.mx'],
            ['name' => 'Lic. Roberto Díaz Torres', 'email' => 'juez4@tribunal.gob.mx'],
            ['name' => 'Lic. Laura Ramírez Flores', 'email' => 'juez5@tribunal.gob.mx'],
        ];

        foreach ($jueces as $juez) {
            User::create([
                'name' => $juez['name'],
                'email' => $juez['email'],
                'password' => Hash::make('juez123'),
                'role_id' => $juezRole->id,
                'email_verified_at' => now(),
            ]);
        }

        $this->command->info('✅ Usuarios creados exitosamente:');
        $this->command->info('Administrador: admin@tribunal.gob.mx / admin123');
        $this->command->info('Secretario: secretario@tribunal.gob.mx / secretario123');
        $this->command->info('Jueces: juez1-5@tribunal.gob.mx / juez123');
    }
}