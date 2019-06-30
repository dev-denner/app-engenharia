<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    $container['view'] = function ($c) {
        $settings = $c->get('settings');
        $cache    = ['cache' => false];
        if (!getenv('DEBUG')) {
            $cache = ['cache' => $settings['viewCache']];
        }
        $view = new \Slim\Views\Twig($settings['renderer']['template_path'], $cache);

        $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

        return $view;
    };

    return $container;
};