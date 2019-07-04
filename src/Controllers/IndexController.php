<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Relatorio;
use App\Models\Usuario;

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

    public function indexClient(Request $request, Response $response, $args)
    {
        $idUser = $_SESSION['cliente_logged_in'];
        $usuario = (new Usuario())->getById($idUser);
        $relatorio = new Relatorio();
        $this->data['usuario'] = $usuario[0];
        $this->data['arrecadacaoAtual'] = $relatorio->arrecadacaoAtualByUsuario($idUser);
        $this->data['arrecadacaoTotal'] = $relatorio->arrecadacaoTotalByUsuario($idUser);
        $this->data['valorRecebido'] = $relatorio->valorRecebidoByUsuario($idUser);
        return $this->view->render($response, 'indexClient.phtml', $this->data);
    }
}
