<?php

use Slim\App;

return function (App $app) {

    $app->get('/', '\App\Controllers\IndexController:index');
    $app->get('/index', '\App\Controllers\IndexController:index');
    $app->group(
        '/grupos',
        function () {
            $this->get('', '\App\Controllers\GrupoController:index');
            $this->get('/{id:[0-9]+}', '\App\Controllers\GrupoController:edit');
            $this->post('', '\App\Controllers\GrupoController:store');
            $this->post('/{id:[0-9]+}', '\App\Controllers\GrupoController:update');
            $this->post('/{id:[0-9]+}/del', '\App\Controllers\GrupoController:destroy');
        }
    );

    $app->group(
        '/usuarios',
        function () {
            $this->get('', '\App\Controllers\UsuarioController:index');
            $this->get('/{id:[0-9]+}', '\App\Controllers\UsuarioController:edit');
            $this->post('', '\App\Controllers\UsuarioController:store');
            $this->post('/{id:[0-9]+}', '\App\Controllers\UsuarioController:update');
            $this->post('/{id:[0-9]+}/del', '\App\Controllers\UsuarioController:destroy');
        }
    );

    $app->group(
        '/pontuacao',
        function () {
            $this->get('', '\App\Controllers\PontuacaoController:index');
            $this->post('', '\App\Controllers\PontuacaoController:update');
        }
    );

    $app->group(
        '/fechamento',
        function () {
            $this->get('', '\App\Controllers\FechamentoController:index');
            $this->post('', '\App\Controllers\FechamentoController:store');
        }
    );

    $app->group(
        '/login',
        function () {
            $this->get('', '\App\Controllers\LoginController:indexAdmin');
            $this->post('', '\App\Controllers\LoginController:logonAdmin');
            $this->get('/logout', '\App\Controllers\LoginController:logout');
        }
    );
    $app->group(
        '/cliente',
        function () {
            $this->group(
                '/login',
                function () {
                    $this->get('', '\App\Controllers\LoginController:indexClient');
                    $this->post('', '\App\Controllers\LoginController:logonClient');
                }
            );
            $this->get('/index', '\App\Controllers\IndexController:indexClient');
        }
    );

    return $app;
};
