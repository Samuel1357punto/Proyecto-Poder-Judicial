<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AcuerdoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\PermanenciaController;
use App\Http\Controllers\RecepcionDocumentoController;
use Illuminate\Support\Facades\Route;

// Ruta principal - redirige según el rol
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        
        if ($user->isSecretario()) {
            return redirect()->route('acuerdos.index');
        } elseif ($user->isJuez()) {
            return redirect()->route('asistencias.index');
        } elseif ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard - principalmente para administradores
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Redirigir según el rol
    if ($user->isSecretario()) {
        return redirect()->route('acuerdos.index');
    } elseif ($user->isJuez()) {
        return redirect()->route('asistencias.index');
    }
    
    // Si es admin, mostrar el dashboard
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas autenticadas
Route::middleware('auth')->group(function () {
    
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ========================================
    // ACUERDOS - Secretarios y Administradores
    // ========================================
    Route::middleware('secretario')->group(function () {
        Route::get('/acuerdos', [AcuerdoController::class, 'index'])->name('acuerdos.index');
        Route::post('/acuerdos', [AcuerdoController::class, 'store'])->name('acuerdos.store');
        Route::get('/acuerdos/create', [AcuerdoController::class, 'create'])->name('acuerdos.create');
        Route::get('/acuerdos/{acuerdo}/edit', [AcuerdoController::class, 'edit'])->name('acuerdos.edit');
        Route::put('/acuerdos/{acuerdo}', [AcuerdoController::class, 'update'])->name('acuerdos.update');
        Route::delete('/acuerdos/{acuerdo}', [AcuerdoController::class, 'destroy'])->name('acuerdos.destroy');
    });
    
    // ========================================
    // ASISTENCIAS - Jueces y Administradores
    // ========================================
    Route::middleware('juez')->group(function () {
        Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
        Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
    });
    
    // ========================================
    // PERMANENCIAS - Solo Administradores
    // ========================================
    Route::middleware('admin')->group(function () {
        Route::get('/permanencias', [PermanenciaController::class, 'index'])->name('permanencias.index');
        Route::post('/permanencias', [PermanenciaController::class, 'store'])->name('permanencias.store');
        Route::get('/permanencias/create', [PermanenciaController::class, 'create'])->name('permanencias.create');
        Route::get('/permanencias/{permanencia}/edit', [PermanenciaController::class, 'edit'])->name('permanencias.edit');
        Route::put('/permanencias/{permanencia}', [PermanenciaController::class, 'update'])->name('permanencias.update');
        Route::delete('/permanencias/{permanencia}', [PermanenciaController::class, 'destroy'])->name('permanencias.destroy');
    });
    
    // ========================================
    // CALIFICACIONES (antes Recepción de Documentos) - Solo Administradores
    // ========================================
    Route::middleware('admin')->group(function () {
        Route::get('/calificaciones', [RecepcionDocumentoController::class, 'index'])->name('recepcion-documentos.index');
        Route::get('/calificaciones/create', [RecepcionDocumentoController::class, 'create'])->name('recepcion-documentos.create');
        Route::post('/calificaciones', [RecepcionDocumentoController::class, 'store'])->name('recepcion-documentos.store');
        Route::get('/calificaciones/{documento}', [RecepcionDocumentoController::class, 'show'])->name('recepcion-documentos.show');
        Route::post('/calificaciones/cargar-datos', [RecepcionDocumentoController::class, 'cargarDatosJuez'])->name('calificaciones.cargar-datos');
    });
});

// Rutas de autenticación
require __DIR__.'/auth.php';