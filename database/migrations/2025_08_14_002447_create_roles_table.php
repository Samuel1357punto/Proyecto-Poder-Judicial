<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Crear tabla de roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Agregar columna role_id a la tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(3)->after('email');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
        });

        // Insertar roles por defecto
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'administrador',
                'description' => 'Acceso completo al sistema - Gestión de estímulos y evaluación',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'secretario',
                'description' => 'Secretario de Acuerdos - Gestión de acuerdos judiciales',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'juez',
                'description' => 'Juez - Control de asistencias y permanencias',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
        
        Schema::dropIfExists('roles');
    }
};