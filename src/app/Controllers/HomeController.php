<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController
{
    /**
     * @var View
     */
    protected $view;

    /**
     * HomeController constructor.
     * @param View $view
     */
    function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @param Request $request≤
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response) : ResponseInterface
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