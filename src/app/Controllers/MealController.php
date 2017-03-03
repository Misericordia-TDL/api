<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Meal;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class MealController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class MealController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Meal
     */
    protected $mealModel;

    /**
     * MealController constructor.
     * @param View $view
     * @param Meal $mealModel
     */
    function __construct(
        View $view,
        Meal $mealModel
    )
    {
        $this->view = $view;
        $this->mealModel = $mealModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '{
        "serve_date": "03-03-1980",
        "refugee_id": 100,
        "menu": []
      }';
        $mealData = json_decode($json, true);
        //$this->mealModel->insert($mealData);
        $data = ['data' => $this->mealModel->findAll()];

        return $this->view->render($response, 'partials/home/index.twig', $data);
    }
}