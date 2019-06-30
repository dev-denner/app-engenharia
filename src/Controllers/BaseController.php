<?php

namespace App\Controllers;

class BaseController
{
    protected $container;
    protected $view;
    protected $data;

    public function __construct($container)
    {
        $this->container                  = $container;
        $this->view                       = $container->get('view');
        $this->data['url']                = getenv('BASEURI');
    }
}