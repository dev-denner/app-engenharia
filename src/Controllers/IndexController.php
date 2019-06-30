<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class IndexController extends BaseController
{
    public function __construct($container)
    {
        parent::__construct($container);
        $this->data['title_page'] = 'Index';
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'index.phtml', $this->data);
    }
}