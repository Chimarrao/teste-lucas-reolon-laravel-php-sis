<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AssistenteMiddleware
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
        if (Auth::check() && (Auth::user()->role === 'assistente' || Auth::user()->role === 'secretaria')) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
