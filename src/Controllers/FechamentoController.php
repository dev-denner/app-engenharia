<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class FechamentoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Fechamento';
        $this->data['active_fechamento'] = 'active';
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'fechamento.phtml', $this->data);
    }
}