<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $municipios = Municipio::all();
        
        // Si es juez, mostrar solo sus asistencias
        if (auth()->user()->isJuez()) {
            $asistencias = Asistencia::where('empleado', auth()->user()->name)
                ->whereMonth('fecha', Carbon::now()->month)
                ->whereYear('fecha', Carbon::now()->year)
                ->orderBy('fecha', 'desc')
                ->orderBy('hora', 'desc')
                ->get();
            
            return view('asistencias.index', compact('asistencias', 'municipios'));
        }
        
        // Si es admin, puede ver todas las asistencias
        $municipioId = $request->get('municipio_id');
        $asistencias = Asistencia::when($municipioId, function($query) use ($municipioId) {
                return $query->where('municipio_id', $municipioId);
            })
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();
        
        return view('asistencias.index', compact('municipios', 'asistencias'));
    }

    public function store(Request $request)
    {
        // Validación básica
        $validated = $request->validate([
            'tipo' => 'required|in:E,S',
            'empleado' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'municipio_id' => 'required|exists:municipios,id'
        ]);

        // Verificar si ya existe un registro del mismo tipo en el día
        $existeRegistro = Asistencia::where('empleado', $validated['empleado'])
            ->where('fecha', $validated['fecha'])
            ->where('tipo', $validated['tipo'])
            ->first();

        if ($existeRegistro) {
            return redirect()->back()->with('error', 'Ya existe un registro de ' . 
                ($validated['tipo'] == 'E' ? 'entrada' : 'salida') . ' para hoy.');
        }

        // Crear el registro
        Asistencia::create($validated);

        $mensaje = $validated['tipo'] == 'E' 
            ? 'Entrada registrada exitosamente' 
            : 'Salida registrada exitosamente';

        return redirect()->route('asistencias.index')->with('success', $mensaje);
    }
}