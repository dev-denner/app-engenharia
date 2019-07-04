<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuario;

class LoginController extends BaseController
{

    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page']   = 'Login';
        $this->data['mensagens']    = $this->flash->getMessages();
    }

    public function indexAdmin(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'login.phtml', $this->data);
    }

    public function logonAdmin(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $user = $data['usuario'];
        $pass = $data['senha'];
        if ($user === 'admin' && $pass === 'waste123') {
            $_SESSION['admin_logged_in'] = true;
            return $response->withRedirect($this->data['url'] . 'index');
        }
        $this->flash->addMessage('Não foi possível realizar o login:', 'Usuário ou senha inválido!');
        return $response->withRedirect($this->data['url'] . 'login');
    }

    public function logout(Request $request, Response $response, $args)
    {
        unset($_SESSION);
        return $response->withRedirect($this->data['url'] . 'login');
    }

    public function indexClient(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'loginClient.phtml', $this->data);
    }

    public function logonClient(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $email = $data['email'];

        $user = (new Usuario())->getByEmail($email);

        if (!empty($user)) {
            $_SESSION['cliente_logged_in'] = $user[0]['id'];
            return $response->withRedirect($this->data['url'] . 'cliente/index');
        }
        $this->flash->addMessage('Não foi possível realizar o login:', 'E-mail não cadastrado!');
        return $response->withRedirect($this->data['url'] . 'cliente/login');
    }
}
