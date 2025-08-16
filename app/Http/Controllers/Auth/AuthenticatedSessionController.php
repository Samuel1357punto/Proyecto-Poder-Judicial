<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Redirigir según el rol del usuario
        $user = Auth::user();
        
        if ($user->isSecretario()) {
            // Secretario va directo a la gestión de acuerdos
            return redirect()->route('acuerdos.index');
        } elseif ($user->isJuez()) {
            // Juez va al control de asistencias
            return redirect()->route('asistencias.index');
        } elseif ($user->isAdmin()) {
            // Administrador va al dashboard general
            return redirect()->route('dashboard');
        }
        
        // Por defecto al dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}