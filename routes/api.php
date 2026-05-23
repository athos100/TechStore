<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de API
|--------------------------------------------------------------------------
|
| Aqui e onde voce pode registrar as rotas de API da aplicacao. Estas
| rotas sao carregadas pelo RouteServiceProvider e todas elas
| serao atribuidas ao grupo de middleware "api".
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
