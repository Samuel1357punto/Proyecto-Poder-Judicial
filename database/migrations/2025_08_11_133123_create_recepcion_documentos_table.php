<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recepcion_documentos', function (Blueprint $table) {
            $table->id();
            
            // Puntualidad y permanencia
            $table->integer('permanencia')->nullable();
            $table->integer('puntualidad')->nullable();
            $table->integer('puntos_permanencia')->nullable();
            $table->integer('puntos_puntualidad')->nullable();
            $table->integer('puntos_total_permanencia')->nullable();

            // Carga de trabajo
            $table->integer('categoria_a')->nullable();
            $table->integer('categoria_b')->nullable();
            $table->integer('categoria_c')->nullable();
            $table->integer('puntos_carga_trabajo')->nullable();

            // Radicaciones, sentencias, órdenes, recursos
            $table->integer('radicaciones_dest_normal')->nullable();
            $table->integer('radicaciones_dest_acumulado')->nullable();
            $table->integer('radicaciones_total_dest')->nullable();
            $table->integer('radicaciones_total')->nullable();
            $table->integer('radicaciones_cumplimiento')->nullable();
            $table->integer('radicaciones_puntos')->nullable();

            $table->integer('sentencias_dest_normal')->nullable();
            $table->integer('sentencias_dest_acumulado')->nullable();
            $table->integer('sentencias_total_dest')->nullable();
            $table->integer('sentencias_total')->nullable();
            $table->integer('sentencias_cumplimiento')->nullable();
            $table->integer('sentencias_puntos')->nullable();

            $table->integer('ordenes_dest_normal')->nullable();
            $table->integer('ordenes_dest_acumulado')->nullable();
            $table->integer('ordenes_total_dest')->nullable();
            $table->integer('ordenes_total')->nullable();
            $table->integer('ordenes_cumplimiento')->nullable();
            $table->integer('ordenes_puntos')->nullable();

            $table->integer('recursos_dest_normal')->nullable();
            $table->integer('recursos_dest_acumulado')->nullable();
            $table->integer('recursos_total_dest')->nullable();
            $table->integer('recursos_total')->nullable();
            $table->integer('recursos_cumplimiento')->nullable();
            $table->integer('recursos_puntos')->nullable();

            $table->integer('puntos_total_radicaciones')->nullable();

            // Remisión listas de acuerdo
            $table->integer('listas_en_tiempo')->nullable();
            $table->integer('listas_dest_tiempo')->nullable();
            $table->integer('listas_total')->nullable();
            $table->integer('listas_cumplimiento')->nullable();
            $table->integer('listas_puntos')->nullable();

            // Percepción por destino
            $table->string('reside_fuera_dom')->nullable();
            $table->integer('puntos_percepcion')->nullable();

            // Resultados segunda instancia
            $table->integer('resoluciones_confirmadas')->nullable();
            $table->integer('resoluciones_modificadas')->nullable();
            $table->integer('resoluciones_revocadas')->nullable();
            $table->integer('total_resoluciones')->nullable();
            $table->integer('puntos_resultados')->nullable();

            $table->integer('amparos_negados')->nullable();
            $table->integer('amparos_concedidos')->nullable();
            $table->integer('total_amparos')->nullable();
            $table->integer('calidad_amparos')->nullable();

            // Evaluación total
            $table->integer('total_puntos')->nullable();
            $table->integer('diferencia_mes_anterior')->nullable();
            $table->decimal('importe', 10, 2)->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepcion_documentos');
    }
};
