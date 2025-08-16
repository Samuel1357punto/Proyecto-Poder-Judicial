<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es administrador
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            // Si es una petición AJAX, devolver error JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'No tienes permisos para realizar esta acción.'
                ], 403);
            }
            
            // Redirigir al dashboard con mensaje de error
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}