<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecretariaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se tem o papel "secretaria"
        if (Auth::check() && Auth::user()->role === 'secretaria') {
            return $next($request);
        }

        // Se o papel não for "secretaria", redireciona com uma mensagem de erro
        return redirect('/dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
