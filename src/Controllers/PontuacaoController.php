<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Pontuacao;

class PontuacaoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page']       = 'Pontuação';
        $this->data['active_pontuacao'] = 'active';
        $this->data['mensagens']        = $this->flash->getMessages();
    }

    public function index(Request $request, Response $response, $args)
    {
        $pontuacao = new Pontuacao();
        $pontuacao->setUsuariosInPontuacao();
        $this->data['pontuacao'] = $pontuacao->get();
        return $this->view->render($response, 'pontuacao.phtml', $this->data);
    }

    public function store(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Pontuacao())->store($data);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível criar uma nova Pontuação');
        }
        return $response->withRedirect($this->data['url'] . 'pontuacao');
    }

    public function update(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Pontuacao())->atualiza($data, $data['id']);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível atualizar a Pontuação');
        }
        return $response->withRedirect($this->data['url'] . 'pontuacao');
    }
}