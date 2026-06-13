<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Nomes dos atributos que não devem ser removidos com trim. 
     * Esses campos geralmente contêm informações sensíveis, como senhas, e não devem ser modificados para garantir a segurança dos dados dos usuários.
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}