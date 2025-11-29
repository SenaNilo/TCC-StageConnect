<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Adicione este bloco para tratar o erro 419
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            return redirect()
                ->route('login') // Ou ->back() se preferir
                ->with('error', 'A página expirou por inatividade. Por favor, tente novamente.');
        });
    })->create();
