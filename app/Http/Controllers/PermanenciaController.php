<?php

namespace App\Http\Controllers;

use App\Models\Permanencia;
use App\Models\User;
use Illuminate\Http\Request;

class PermanenciaController extends Controller
{
    public function index()
    {
        $registros = Permanencia::orderBy('fecha', 'desc')->get();
        $jueces = User::where('role_id', 3)->get(); // Solo jueces
        
        return view('permanencia.index', compact('registros', 'jueces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_juez' => 'required|string|max:255',
            'adscripcion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'permanencia' => 'required|in:Sí,No',
            'observacion' => 'nullable|string|max:500'
        ]);

        // Generar número de empleado automático
        $lastPermanencia = Permanencia::orderBy('id', 'desc')->first();
        $numeroEmpleado = $lastPermanencia ? ($lastPermanencia->id + 1) : 1;
        
        $validated['numero_empleado'] = str_pad($numeroEmpleado, 5, '0', STR_PAD_LEFT);

        Permanencia::create($validated);

        return redirect()->route('permanencias.index')
            ->with('success', 'Registro de permanencia guardado exitosamente');
    }
}