<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Clothe;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ClotheController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class ClotheController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Clothe
     */
    protected $clotheModel;

    /**
     * ClotheController constructor.
     * @param View $view
     * @param Clothe $clotheModel
     */
    function __construct(
        View $view,
        Clothe $clotheModel
    )
    {
        $this->view = $view;
        $this->clotheModel = $clotheModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '
  {
    "name": "tshirt",
    "arrival_date": "03-03-1980",
    "size": "XL",
    "quantity": 40
  }
  ';
        $clotheData = json_decode($json, true);
        $this->clotheModel->insert($clotheData);
        $data = ['data' => $this->clotheModel->findAll()];

        return $this->view->render($response, 'partials/home/index.twig', $data);
    }
}