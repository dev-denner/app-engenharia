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

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'login.phtml', $this->data);
    }

    public function logon(Request $request, Response $response, $args)
    {
        $data   = $request->getParams();
        $user = $data['usuario'];
        $pass = $data['senha'];
        if ($user === 'admin' && $pass === 'waste123') {
            $_SESSION['user_logged_in'] = true;
            return $response->withRedirect($this->data['url'] . 'index');
        }
        return $response->withRedirect($this->data['url'] . 'login');
    }

    public function logout(Request $request, Response $response, $args)
    {
        unset($_SESSION['user_logged_in']);
        return $response->withRedirect($this->data['url'] . 'login');
    }
}
