<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recepcion_documentos', function (Blueprint $table) {
            // Agregar campos faltantes si no existen
            if (!Schema::hasColumn('recepcion_documentos', 'juez_id')) {
                $table->unsignedBigInteger('juez_id')->nullable()->after('id');
                $table->foreign('juez_id')->references('id')->on('users')->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('recepcion_documentos', 'periodo')) {
                $table->string('periodo')->nullable()->after('juez_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('recepcion_documentos', function (Blueprint $table) {
            if (Schema::hasColumn('recepcion_documentos', 'juez_id')) {
                $table->dropForeign(['juez_id']);
                $table->dropColumn('juez_id');
            }
            
            if (Schema::hasColumn('recepcion_documentos', 'periodo')) {
                $table->dropColumn('periodo');
            }
        });
    }
};