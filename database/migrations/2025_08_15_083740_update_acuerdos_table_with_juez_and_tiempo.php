<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('acuerdos', function (Blueprint $table) {
            if (!Schema::hasColumn('acuerdos', 'juez_id')) {
                $table->unsignedBigInteger('juez_id')->nullable()->after('id');
                $table->foreign('juez_id')->references('id')->on('users')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('acuerdos', 'secretario_id')) {
                $table->unsignedBigInteger('secretario_id')->nullable()->after('juez_id');
                $table->foreign('secretario_id')->references('id')->on('users')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('acuerdos', 'fecha_limite')) {
                $table->datetime('fecha_limite')->nullable()->after('acuerdo');
            }
            
            if (!Schema::hasColumn('acuerdos', 'fecha_publicacion')) {
                $table->datetime('fecha_publicacion')->nullable()->after('fecha_limite');
            }
            
            if (!Schema::hasColumn('acuerdos', 'estado_tiempo')) {
                $table->enum('estado_tiempo', ['A_TIEMPO', 'DESTIEMPO'])->default('A_TIEMPO')->after('fecha_publicacion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('acuerdos', function (Blueprint $table) {
            if (Schema::hasColumn('acuerdos', 'juez_id')) {
                $table->dropForeign(['juez_id']);
                $table->dropColumn('juez_id');
            }
            if (Schema::hasColumn('acuerdos', 'secretario_id')) {
                $table->dropForeign(['secretario_id']);
                $table->dropColumn('secretario_id');
            }
            $table->dropColumn(['fecha_limite', 'fecha_publicacion', 'estado_tiempo']);
        });
    }
};