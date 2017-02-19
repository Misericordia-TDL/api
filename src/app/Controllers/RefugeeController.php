<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Refugee;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class RefugeeController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class RefugeeController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Refugee
     */
    protected $refugeeModel;

    /**
     * RefugeeController constructor.
     * @param View $view
     * @param Refugee $refugeeModel
     */
    function __construct(
        View $view,
        Refugee $refugeeModel
    )
    {
        $this->view = $view;
        $this->refugeeModel = $refugeeModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '{
    "name": "John",
    "surname": "Refugee",
    "birth_date": "03-03-1980",
    "state_origin": "Atlantis",
    "profession": "Athlete",
    "phone_number": "00447773651107",
    "meals": [],
    "medical_aid": [],
    "clothing": [],
    "home": []
  }';
        $refugeeData = json_decode($json, true);
        //$this->refugeeModel->insert($refugeeData);
        $data = ['data' => $this->refugeeModel->findAll()];
        //$data = ['data' => $this->refugeeModel->findById('58a8aea7a97b86b00126dba63')];

        return $this->view->render($response, 'home/index.twig', $data);
    }
}