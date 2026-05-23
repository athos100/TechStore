<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*Esse middleware bloqueia acesso de quem não é admin. ou seja ele verifica se o usuário é um administrador */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin') {
            abort(403, 'Acesso restrito ao administrador.');
        }

        return $next($request);
    }
}
