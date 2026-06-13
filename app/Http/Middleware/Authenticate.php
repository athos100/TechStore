<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

// Middleware responsável por garantir que apenas usuários autenticados possam acessar determinadas rotas da aplicação. Ele verifica se o usuário está logado e, caso contrário, redireciona para a página de login ou retorna uma resposta JSON adequada para requisições AJAX. Esse middleware é fundamental para proteger as áreas restritas da aplicação e garantir a segurança dos dados dos usuários.
class Authenticate extends Middleware
{
    /**
     * Obtém o caminho para onde o usuário deve ser redirecionado quando não estiver autenticado.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
