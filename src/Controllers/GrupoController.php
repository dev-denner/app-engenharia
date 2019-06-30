<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class GrupoController
{
    private $container;
    private $data;

    public function __construct($container)
    {
        $this->container = $container;
        $this->data['title_page'] = 'Grupo';
    }

    public function index(Request $request, Response $response, $args)
    {
        $view = $this->container->get('view');
        return $view->render($response, 'grupos.phtml', $this->data);
    }
}