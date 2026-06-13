<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Controlador base da aplicação, do qual todos os outros controladores herdam. Ele inclui funcionalidades comuns, como autorização e validação de requisições, para garantir uma estrutura consistente em toda a aplicação.
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
