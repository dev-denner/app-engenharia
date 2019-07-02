<?php

use Slim\App;

return function (App $app) {

    $app->get('/', '\App\Controllers\IndexController:index');
    $app->get('/index', '\App\Controllers\IndexController:index');
    $app->group('/grupos',
        function () {
        $this->get('', '\App\Controllers\GrupoController:index');
        $this->get('/{id:[0-9]+}', '\App\Controllers\GrupoController:edit');
        $this->post('', '\App\Controllers\GrupoController:store');
        $this->post('/{id:[0-9]+}', '\App\Controllers\GrupoController:update');
        $this->post('/{id:[0-9]+}/del', '\App\Controllers\GrupoController:destroy');
    });

    $app->group('/usuarios',
        function () {
        $this->get('', '\App\Controllers\UsuarioController:index');
        $this->get('/{id:[0-9]+}', '\App\Controllers\UsuarioController:edit');
        $this->post('', '\App\Controllers\UsuarioController:store');
        $this->post('/{id:[0-9]+}', '\App\Controllers\UsuarioController:update');
        $this->post('/{id:[0-9]+}/del', '\App\Controllers\UsuarioController:destroy');
    });

    $app->get('/login', '\App\Controllers\LoginController:index');
    $app->get('/pontuacao', '\App\Controllers\PontuacaoController:index');
    $app->get('/fechamento', '\App\Controllers\FechamentoController:index');

    return $app;
};
