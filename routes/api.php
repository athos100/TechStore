<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de API
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas de API da aplicação. Estas
| rotas são carregadas pelo RouteServiceProvider e todas elas
| serao atribuidas ao grupo de middleware "api".
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
