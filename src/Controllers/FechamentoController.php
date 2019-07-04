<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Fechamento;

class FechamentoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Fechamento';
        $this->data['active_fechamento'] = 'active';
        $this->data['mensagens']    = $this->flash->getMessages();
    }

    public function index(Request $request, Response $response, $args)
    {
        $fechamento = new Fechamento();
        $this->data['fechamento'] = $fechamento->get();
        $this->data['total'] = $fechamento->getTotalKg()[0]['total'];
        return $this->view->render($response, 'fechamento.phtml', $this->data);
    }

    public function store(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Fechamento())->store($data);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível fazer o encerramento.');
        }
        return $response->withRedirect($this->data['url'] . 'fechamento');
    }
}
