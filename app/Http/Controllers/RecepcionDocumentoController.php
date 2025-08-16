<?php

namespace App\Http\Controllers;

use App\Models\RecepcionDocumento;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\Permanencia;
use App\Models\Acuerdo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RecepcionDocumentoController extends Controller
{
    public function index()
    {
        $jueces = User::where('role_id', 3)->orderBy('name')->get();
        $documentos = RecepcionDocumento::with('juez')->orderBy('created_at', 'desc')->get();
        
        return view('recepcion-documentos.index', compact('documentos', 'jueces'));
    }

    public function cargarDatosJuez(Request $request)
    {
        $juezId = $request->input('juez_id');
        $periodo = $request->input('periodo');
        
        if (!$juezId || !$periodo) {
            return response()->json(['error' => 'Faltan parámetros'], 400);
        }

        // Parsear el periodo (formato: YYYY-MM)
        $fechaInicio = Carbon::parse($periodo . '-01')->startOfMonth();
        $fechaFin = Carbon::parse($periodo . '-01')->endOfMonth();

        // 1. Calcular PUNTUALIDAD (asistencias a tiempo)
        $asistencias = Asistencia::where('empleado', User::find($juezId)->name)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('tipo', 'E') // Solo entradas
            ->get();

        $totalEntradas = $asistencias->count();
        $entradasATiempo = $asistencias->filter(function($a) {
            return Carbon::parse($a->hora)->lte(Carbon::parse('08:00:00'));
        })->count();

        // 2. Calcular PERMANENCIA
        $permanencias = Permanencia::where('nombre_juez', User::find($juezId)->name)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        $totalPermanencias = $permanencias->count();
        $permanenciasPositivas = $permanencias->where('permanencia', 'Sí')->count();

        // 3. Calcular ACUERDOS (Listas de acuerdos)
        $acuerdos = Acuerdo::where('juez_id', $juezId)
            ->whereBetween('fecha_publicacion', [$fechaInicio, $fechaFin])
            ->get();

        $acuerdosATiempo = $acuerdos->where('estado_tiempo', 'A_TIEMPO')->count();
        $acuerdosDestiempo = $acuerdos->where('estado_tiempo', 'DESTIEMPO')->count();

        // 4. Buscar si ya existe una evaluación para este periodo
        $evaluacionExistente = RecepcionDocumento::where('juez_id', $juezId)
            ->where('periodo', $periodo)
            ->first();

        $datos = [
            'puntualidad' => $entradasATiempo,
            'permanencia' => $permanenciasPositivas,
            'total_entradas' => $totalEntradas,
            'total_permanencias' => $totalPermanencias,
            'listas_en_tiempo' => $acuerdosATiempo,
            'listas_destiempo' => $acuerdosDestiempo,
            'evaluacion_existente' => $evaluacionExistente
        ];

        return response()->json($datos);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'juez_id' => 'required|exists:users,id',
            'periodo' => 'required|string',
            'permanencia' => 'nullable|integer',
            'puntualidad' => 'nullable|integer',
            'puntos_permanencia' => 'nullable|integer',
            'puntos_puntualidad' => 'nullable|integer',
            'puntos_total_permanencia' => 'nullable|integer',
            'categoria_a' => 'nullable|integer',
            'categoria_b' => 'nullable|integer',
            'categoria_c' => 'nullable|integer',
            'puntos_carga_trabajo' => 'nullable|integer',
            'radicaciones_dest_normal' => 'nullable|integer',
            'radicaciones_dest_acumulado' => 'nullable|integer',
            'radicaciones_total_dest' => 'nullable|integer',
            'radicaciones_total' => 'nullable|integer',
            'radicaciones_cumplimiento' => 'nullable|numeric',
            'radicaciones_puntos' => 'nullable|integer',
            'sentencias_dest_normal' => 'nullable|integer',
            'sentencias_dest_acumulado' => 'nullable|integer',
            'sentencias_total_dest' => 'nullable|integer',
            'sentencias_total' => 'nullable|integer',
            'sentencias_cumplimiento' => 'nullable|numeric',
            'sentencias_puntos' => 'nullable|integer',
            'ordenes_dest_normal' => 'nullable|integer',
            'ordenes_dest_acumulado' => 'nullable|integer',
            'ordenes_total_dest' => 'nullable|integer',
            'ordenes_total' => 'nullable|integer',
            'ordenes_cumplimiento' => 'nullable|numeric',
            'ordenes_puntos' => 'nullable|integer',
            'recursos_dest_normal' => 'nullable|integer',
            'recursos_dest_acumulado' => 'nullable|integer',
            'recursos_total_dest' => 'nullable|integer',
            'recursos_total' => 'nullable|integer',
            'recursos_cumplimiento' => 'nullable|numeric',
            'recursos_puntos' => 'nullable|integer',
            'puntos_total_radicaciones' => 'nullable|integer',
            'listas_en_tiempo' => 'nullable|integer',
            'listas_dest_tiempo' => 'nullable|integer',
            'listas_total' => 'nullable|integer',
            'listas_cumplimiento' => 'nullable|numeric',
            'listas_puntos' => 'nullable|integer',
            'reside_fuera_dom' => 'nullable|string',
            'puntos_percepcion' => 'nullable|integer',
            'resoluciones_confirmadas' => 'nullable|integer',
            'resoluciones_modificadas' => 'nullable|integer',
            'resoluciones_revocadas' => 'nullable|integer',
            'total_resoluciones' => 'nullable|integer',
            'puntos_resultados' => 'nullable|integer',
            'amparos_negados' => 'nullable|integer',
            'amparos_concedidos' => 'nullable|integer',
            'total_amparos' => 'nullable|integer',
            'calidad_amparos' => 'nullable|numeric',
            'total_puntos' => 'nullable|integer',
            'diferencia_mes_anterior' => 'nullable|integer',
            'importe' => 'nullable|numeric'
        ]);

        // Verificar si ya existe una evaluación para este juez y periodo
        $existe = RecepcionDocumento::where('juez_id', $validated['juez_id'])
            ->where('periodo', $validated['periodo'])
            ->first();

        if ($existe) {
            // Actualizar la existente
            $existe->update($validated);
            $mensaje = 'Calificación actualizada exitosamente';
        } else {
            // Crear nueva
            RecepcionDocumento::create($validated);
            $mensaje = 'Calificación guardada exitosamente';
        }

        return redirect()->route('recepcion-documentos.index')
            ->with('success', $mensaje);
    }
}