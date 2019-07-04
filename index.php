<?php

date_default_timezone_set('America/Sao_paulo');

if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/vendor/autoload.php';

session_start();

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (getenv('DEBUG')) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

$dependencies = require __DIR__ . '/src/dependencies.php';
$dependencies($app);

$middleware = require __DIR__ . '/src/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/src/routes.php';
$routes($app);

$app->run();
