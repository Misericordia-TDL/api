<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

class HomeController
{
    protected $view;

    function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $arrayData = [
            'index1' => 'value1',
            'index2' => 'value2',
            'index3' => 'value3',
        ];
        $data = ['data' => $arrayData];
       return $this->view->render($response, 'home/index.twig', $data);
    }
}