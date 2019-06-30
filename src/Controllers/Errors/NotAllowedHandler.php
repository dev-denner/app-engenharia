<?php

namespace App\Controllers\Errors;

use Slim\Handlers\NotAllowed;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotAllowedHandler extends NotAllowed
{

    private $container;
    private $methods;

    public function __construct($container, $methods)
    {
        $this->container = $container;
        $this->methods = $methods;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        parent::__invoke($request, $response, $this->methods);

        $this->data['methods'] = implode(',', $this->methods);

        $view = $this->container->get('view');
        $view->render($response, 'errors/405.phtml', $this->data);

        return $response->withStatus(405);
    }
}