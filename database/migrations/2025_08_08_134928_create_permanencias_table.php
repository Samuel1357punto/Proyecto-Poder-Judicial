<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permanencias', function (Blueprint $table) {
            $table->id();
            $table->string('numero_empleado');
            $table->string('nombre_juez');
            $table->string('adscripcion');
            $table->date('fecha');
            $table->string('permanencia'); // "Sí" o "No"
            $table->string('observacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanencias');
    }
};
