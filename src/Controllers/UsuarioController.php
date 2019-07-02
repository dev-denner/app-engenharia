<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Grupo;
use App\Models\Usuario;

class UsuarioController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page']   = 'Grupo';
        $this->data['active_usuario'] = 'active';
        $this->data['mensagens']    = $this->flash->getMessages();
    }

    public function index(Request $request, Response $response, $args)
    {
        $this->data['usuarios'] = (new Usuario())->get();
        $this->data['grupos'] = (new Grupo())->get();
        return $this->view->render($response, 'usuario.phtml', $this->data);
    }

    public function edit(Request $request, Response $response, $args)
    {
        $usuario = (new Usuario())->getById($args['id'])[0];
        if (empty($usuario)) {
            $this->flash->addMessage('Usuário não encontrado!', "O usuário {$args['id']} não foi encontrado ou não existe!");
        }

        $this->data['usuario'] = $usuario;
        $this->data['usuarios'] = (new Usuario())->get();
        $this->data['grupos'] = (new Grupo())->get();
        return $this->view->render($response, 'usuario.phtml', $this->data);
    }

    public function store(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Usuario())->store($data);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível criar um novo Usuário');
        }
        return $response->withRedirect('/usuarios');
    }

    public function update(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $return = (new Usuario())->atualiza($data, $args['id']);
        if (!$return) {
            $this->flash->addMessage('Tente novamente!', 'Não foi possível atualizar o Usuário');
        }
        return $response->withRedirect('/usuarios');
    }

    public function destroy(Request $request, Response $response, $args)
    {
        return (new Usuario())->delete($args['id']);
    }
}