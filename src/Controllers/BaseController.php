<?php

namespace App\Controllers;

class BaseController
{
    protected $container;
    protected $view;
    protected $data;
    protected $flash;

    public function __construct($container)
    {
        $this->container   = $container;
        $this->view        = $container->get('view');
        $this->data['url'] = getenv('BASEURI');
        $this->flash       = $container->get('flash');

        $uri = explode('/', $_SERVER['REQUEST_URI']);

        if (end($uri) !== 'login') {
            $agent = 'admin';
            $url = '';
            if ($uri[count($uri) - 2] == 'cliente') {
                $url = 'cliente/';
                $agent = 'cliente';
            }
            if (!isset($_SESSION[$agent . '_logged_in'])) {
                header('location: ' . $this->data['url'] . $url . 'login');
                exit();
            }
        }
    }
}
