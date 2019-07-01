<?php

use Slim\App;

return function (App $app) {

    $app->get('/', '\App\Controllers\IndexController:index');
    $app->get('/index', '\App\Controllers\IndexController:index');
    $app->get('/grupos', '\App\Controllers\GrupoController:index');
    $app->get('/usuarios', '\App\Controllers\UsuarioController:index');
    $app->get('/login', '\App\Controllers\LoginController:index');
    $app->get('/pontuacao', '\App\Controllers\PontuacaoController:index');
    $app->get('/fechamento', '\App\Controllers\FechamentoController:index');

    return $app;
};