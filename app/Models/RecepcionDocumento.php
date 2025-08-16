<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecepcionDocumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'juez_id',
        'periodo',
        'permanencia',
        'puntualidad',
        'puntos_permanencia',
        'puntos_puntualidad',
        'puntos_total_permanencia',
        'categoria_a',
        'categoria_b',
        'categoria_c',
        'puntos_carga_trabajo',
        'radicaciones_dest_normal',
        'radicaciones_dest_acumulado',
        'radicaciones_total_dest',
        'radicaciones_total',
        'radicaciones_cumplimiento',
        'radicaciones_puntos',
        'sentencias_dest_normal',
        'sentencias_dest_acumulado',
        'sentencias_total_dest',
        'sentencias_total',
        'sentencias_cumplimiento',
        'sentencias_puntos',
        'ordenes_dest_normal',
        'ordenes_dest_acumulado',
        'ordenes_total_dest',
        'ordenes_total',
        'ordenes_cumplimiento',
        'ordenes_puntos',
        'recursos_dest_normal',
        'recursos_dest_acumulado',
        'recursos_total_dest',
        'recursos_total',
        'recursos_cumplimiento',
        'recursos_puntos',
        'puntos_total_radicaciones',
        'listas_en_tiempo',
        'listas_dest_tiempo',
        'listas_total',
        'listas_cumplimiento',
        'listas_puntos',
        'reside_fuera_dom',
        'puntos_percepcion',
        'resoluciones_confirmadas',
        'resoluciones_modificadas',
        'resoluciones_revocadas',
        'total_resoluciones',
        'puntos_resultados',
        'amparos_negados',
        'amparos_concedidos',
        'total_amparos',
        'calidad_amparos',
        'total_puntos',
        'diferencia_mes_anterior',
        'importe'
    ];

    /**
     * Relación con el juez evaluado
     */
    public function juez()
    {
        return $this->belongsTo(User::class, 'juez_id');
    }
}