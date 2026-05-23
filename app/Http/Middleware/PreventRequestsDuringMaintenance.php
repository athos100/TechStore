<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * URIs (caminho/endereço) que devem permanecer acessiveis enquanto o modo de manutencao estiver ativo.
     *
     * @var array<int, string>
     */
    // Aqui voce pode adicionar os caminhos que deseja que fiquem acessiveis mesmo quando a aplicacao estiver em manutencao, por exemplo: '/status', '/api/*', etc.
    protected $except = [
        //
    ];
}
