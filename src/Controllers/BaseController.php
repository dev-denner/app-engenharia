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

        if ($_SERVER['REQUEST_URI'] !== '/login') {
            if (!isset($_SESSION['user_logged_in'])) {
                header('location: ' . $this->data['url'] . 'login');
                exit();
            }
        }
    }
}
