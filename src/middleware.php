<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {

    $container = $app->getContainer();

    $container['phpErrorHandler'] = function ($container) {
        return new \App\Controllers\Errors\PhpErrorHandler(
            $container,
            function ($request, $response, $exception) use ($container) {
            $statusCode = $exception->getCode() ? $exception->getCode() : 500;
            $container->get('logger')->addError(
                $exception->getMessage(),
                [
                    'msg'   => $exception->getMessage(),
                    'file'  => $exception->getFile(),
                    'line'  => $exception->getLine(),
                    'trace' => $exception->getTraceAsString()
                ]
            );
            return $container['response']->withStatus($statusCode);
        }
        );
    };

    $container['errorHandler'] = function ($container) {
        return new \App\Controllers\Errors\ErrorHandler(
            $container,
            function ($request, $response, $exception) use ($container) {
            $statusCode = $exception->getCode() ? $exception->getCode() : 500;
            $container->get('logger')->addError(
                $exception->getMessage(),
                [
                    'msg'   => $exception->getMessage(),
                    'file'  => $exception->getFile(),
                    'line'  => $exception->getLine(),
                    'trace' => $exception->getTraceAsString()
                ]
            );
            return $container['response']->withStatus($statusCode);
        }
        );
    };

    $container['notAllowedHandler'] = function ($container) {
        return new \App\Controllers\Errors\NotAllowedHandler($container,
            function ($request, $response, $methods) use ($container) {
            return $container['response']->withStatus(504);
        });
    };

    $container['notFoundHandler'] = function ($container) {
        return new \App\Controllers\Errors\NotFoundHandler($container, function ($request, $response) use ($container) {
            return $container['response']->withStatus(404);
        });
    };

    $app->add(function (Request $request, Response $response, callable $next) {
        $uri  = $request->getUri();
        $path = $uri->getPath();
        if ($path != '/' && substr($path, -1) == '/') {
            $uri = $uri->withPath(substr($path, 0, -1));
            if ($request->getMethod() == 'GET') {
                return $response->withRedirect((string) $uri, 301);
            } else {
                return $next($request->withUri($uri), $response);
            }
        }
        return $next($request, $response);
    });

    return $container;
};
