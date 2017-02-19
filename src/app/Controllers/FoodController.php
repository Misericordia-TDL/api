<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Food;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class FoodController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class FoodController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Food
     */
    protected $foodModel;

    /**
     * FoodController constructor.
     * @param View $view
     * @param Food $foodModel
     */
    function __construct(
        View $view,
        Food $foodModel
    )
    {
        $this->view = $view;
        $this->foodModel = $foodModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '{
    "name": "spaguetti bag",
    "quantity": 40
  }';
        $foodData = json_decode($json, true);
        $this->foodModel->insert($foodData);
        $data = ['data' => $this->foodModel->findAll()];

        return $this->view->render($response, 'home/index.twig', $data);
    }
}