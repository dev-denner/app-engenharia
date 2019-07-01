<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class UsuarioController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Usuário';
        $this->data['active_usuario'] = 'active';
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'usuario.phtml', $this->data);
    }
}