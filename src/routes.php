<?php

use Slim\App;

return function (App $app) {

    $app->get('/', '\App\Controllers\IndexController:index');
    $app->get('/index', '\App\Controllers\IndexController:index');
    $app->get('/grupos', '\App\Controllers\GrupoController:index');

    return $app;
};