<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ForceFreshDBConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ----------------------------------------------------
        // CORREÇÃO CRÍTICA PARA TIMEOUTS EM NUVEM
        // Esta lógica garante que a conexão esteja fresca a cada requisição
        // ----------------------------------------------------
        
        // 1. Purga: Fecha e remove a conexão existente (incluindo a que o MySQL fechou)
        DB::purge(config('database.default')); 
        
        // 2. Reconecta: Abre uma nova conexão limpa, garantindo que o DB esteja ativo
        DB::reconnect(config('database.default')); 

        return $next($request);
    }
}
