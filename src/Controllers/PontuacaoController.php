<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PontuacaoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Pontuação';
        $this->data['active_pontuacao'] = 'active';
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'pontuacao.phtml', $this->data);
    }
}