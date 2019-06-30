<?php

namespace App\Controllers\Errors;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorHandler
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $exception)
    {
        $this->container->get('logger')->addError(
            $exception->getMessage(),
            [
                'msg'   => $exception->getMessage(),
                'file'  => $exception->getFile(),
                'line'  => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]
        );

        $view = $this->container->get('view');
        $view->render($response, 'errors/500.phtml', ['exception' => $exception]);
        return $response->withStatus(500);
    }
}