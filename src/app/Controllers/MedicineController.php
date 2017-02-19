<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\Medicine;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class MedicineController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class MedicineController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Medicine
     */
    protected $medicineModel;

    /**
     * MedicineController constructor.
     * @param View $view
     * @param Medicine $medicineModel
     */
    function __construct(
        View $view,
        Medicine $medicineModel
    )
    {
        $this->view = $view;
        $this->medicineModel = $medicineModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = ' {
    "name": "Ibuprofen",
    "arrival_date": "03-03-1980",
    "expiry_date": "03-03-1980",
    "quantity": 40
  }';
        $foodData = json_decode($json, true);
        $this->medicineModel->insert($foodData);
        $data = ['data' => $this->medicineModel->findAll()];

        return $this->view->render($response, 'home/index.twig', $data);
    }
}