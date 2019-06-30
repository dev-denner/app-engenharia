<?php

namespace App\Controllers\Errors;

use Slim\Handlers\NotFound;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundHandler extends NotFound
{

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        parent::__invoke($request, $response);
        $view = $this->container->get('view');
        $view->render($response, 'errors/404.phtml');

        return $response->withStatus(404);
    }
}