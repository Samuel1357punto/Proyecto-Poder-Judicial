<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registrar todos los middleware como alias
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'secretario' => \App\Http\Middleware\SecretarioMiddleware::class,
            'juez' => \App\Http\Middleware\JuezMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();