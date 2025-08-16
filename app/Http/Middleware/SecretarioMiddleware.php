<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretarioMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isSecretario() && !auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para acceder a esta sección');
        }

        return $next($request);
    }
}