<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Relatorio;

class IndexController extends BaseController
{
    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Index';
    }

    public function index(Request $request, Response $response, $args)
    {
        $relatorio = new Relatorio();
        $this->data['arrecadacaoAtual'] = $relatorio->arrecadacaoAtual();
        $this->data['arrecadacaoTotal'] = $relatorio->arrecadacaoTotal();
        $this->data['valorRecebido'] = $relatorio->valorRecebido();
        return $this->view->render($response, 'index.phtml', $this->data);
    }
}
