<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CadastroMiddleware
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
        if (Auth::check() && (Auth::user()->role === 'cadastro' || Auth::user()->role === 'secretaria' || Auth::user()->role === 'assistente')) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
