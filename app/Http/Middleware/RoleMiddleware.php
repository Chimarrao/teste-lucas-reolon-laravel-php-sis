<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        $userRole = Auth::user()->role ?? null;

        // Verifica se o usuário é "secretaria" ou "assistente"
        if (in_array($userRole, ['secretaria', 'assistente', 'cadastro'])) {
            return $next($request);
        }

        // Se o papel não for permitido, redireciona para uma página de erro
        return redirect('/dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
