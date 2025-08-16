<?php

namespace App\Http\Controllers;

use App\Models\Acuerdo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AcuerdoController extends Controller
{
    public function index()
    {
        $acuerdos = Acuerdo::with(['juez', 'secretario'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $jueces = User::where('role_id', 3)->orderBy('name')->get();
        
        return view('acuerdos.index', compact('acuerdos', 'jueces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'municipio' => 'required|string|max:255',
            'clave_juzgado' => 'required|string|max:50',
            'juzgado' => 'required|string|max:255',
            'materia' => 'required|string|max:100',
            'juez_id' => 'nullable|exists:users,id',
            'estado_tiempo' => 'required|in:A_TIEMPO,DESTIEMPO',
            'acuerdo' => 'nullable|string'
        ]);

        // Asignar el secretario actual
        $validated['secretario_id'] = auth()->id();
        
        // Establecer fecha de publicación actual
        $validated['fecha_publicacion'] = now();
        
        // Establecer fecha límite (hoy a las 15:00)
        $validated['fecha_limite'] = Carbon::today()->setHour(15)->setMinute(0);
        
        // Si no se proporciona acuerdo, generar uno automático
        if (empty($validated['acuerdo'])) {
            $validated['acuerdo'] = 'ACUERDO-' . date('Ymd-His');
        }

        Acuerdo::create($validated);

        return redirect()->route('acuerdos.index')
            ->with('success', 'Lista de acuerdos liberada exitosamente');
    }
}