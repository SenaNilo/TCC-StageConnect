<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // return $next($request);
        // Verifica se o usuário está logado
        if (!Auth::check()) {
            // Se não estiver logado, redireciona para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        // Obtém o usuário logado
        $user = Auth::usuario();

        // Verifica se o tipo de usuário logado corresponde ao tipo esperado
        // Lembre-se que o campo no seu modelo é 'type_user'
        if ($user->type_user === $type) {
            // Se o tipo corresponder, permite que a requisição continue
            return $next($request);
        }

        // Se o tipo não corresponder, redireciona para uma página de erro ou para a home
        // Você pode personalizar este redirecionamento e mensagem
        // ARRUMAR DPS
        return redirect()->route('login')->with('error', 'Você não tem permissão para acessar esta página.');

    }
}
