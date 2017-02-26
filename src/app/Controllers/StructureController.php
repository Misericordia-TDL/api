<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Structure;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class StructureController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class StructureController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Structure
     */
    protected $structureModel;

    /**
     * StructureController constructor.
     * @param View $view
     * @param Structure $structureModel
     */
    function __construct(
        View $view,
        Structure $structureModel
    )
    {
        $this->view = $view;
        $this->structureModel = $structureModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '  {
    "name": "Misericordia Structure",
    "address": "Misericordia st., Rome, Italy",
    "capacity": 100,
    "current_ocupants": []
  }';
        $structureData = json_decode($json, true);
        //$this->structureModel->insert($structureData);
        $data = ['data' => $this->structureModel->findAll()];
        //$data = ['data' => $this->refugeeModel->findById('58a8aea7a97b86b00126dba63')];

        return $this->view->render($response, 'partials/home/index.twig', $data);
    }
}