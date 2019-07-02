<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Grupo;

class GrupoController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page']   = 'Grupo';
        $this->data['active_grupo'] = 'active';
        $this->data['mensagens']    = $this->flash->getMessages();
    }

    public function index(Request $request, Response $response, $args)
    {
        $this->data['grupos'] = (new Grupo())->get();
        return $this->view->render($response, 'grupo.phtml', $this->data);
    }

    public function edit(Request $request, Response $response, $args)
    {
        $grupo = (new Grupo())->getById($args['id'])[0];
        if (empty($grupo)) {
            $this->flash->addMessage('Grupo não encontrado!', "O grupo {$args['id']} não foi encontrado ou não existe!");
        }

        $this->data['grupo'] = $grupo;
        $this->data['grupos'] = (new Grupo())->get();
        return $this->view->render($response, 'grupo.phtml', $this->data);
    }

    public function store(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Grupo())->store($data);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível criar um novo Grupo');
        }
        return $response->withRedirect($this->data['url'] . 'grupos');
    }

    public function update(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Grupo())->atualiza($data, $args['id']);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível atualizar o Grupo');
        }
        return $response->withRedirect($this->data['url'] . 'grupos');
    }

    public function destroy(Request $request, Response $response, $args)
    {
        return (new Grupo())->delete($args['id']);
    }
}
