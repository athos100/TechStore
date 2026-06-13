<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

// Essei é Middleware responsável por criptografar os cookies da aplicação, garantindo a segurança dos dados armazenados nos cookies. Ele protege as informações sensíveis dos usuários, como tokens de autenticação e preferências, contra acesso não autorizado. O middleware também permite especificar quais cookies não devem ser criptografados, caso necessário.
class EncryptCookies extends Middleware
{
    /**
     * Nomes dos cookies que não devem ser criptografados.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
