<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class GrupoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Grupo';
        $this->data['active_grupo'] = 'active';
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'grupo.phtml', $this->data);
    }
}