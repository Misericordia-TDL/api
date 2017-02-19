<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\MedicalAttention;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class MedicalAttentionController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class MedicalAttentionController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var MedicalAttention
     */
    protected $medicalAttentionModel;

    /**
     * MedicineController constructor.
     * @param View $view
     * @param MedicalAttention $medicalAttentionModel
     */
    function __construct(
        View $view,
        MedicalAttention $medicalAttentionModel
    )
    {
        $this->view = $view;
        $this->medicalAttentionModel = $medicalAttentionModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $json = '   {
    "operator_id": "id",
    "refugee_id": "id",
    "treatment": [
    ],
    "visit_date": "03-03-1980",
    "next_appointment_date": "03-03-1980"
  }';
        $medicalAttentionData = json_decode($json, true);
        $this->medicalAttentionModel->insert($medicalAttentionData);
        $data = ['data' => $this->medicalAttentionModel->findAll()];

        return $this->view->render($response, 'home/index.twig', $data);
    }
}