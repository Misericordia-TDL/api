<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Models\Operator;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class createOperator
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class CreateOperatorAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Operator
     */
    protected $operatorModel;

    /**
     * OperatorController constructor.
     * @param View $view
     * @param Operator $operatorModel
     */
    function __construct(
        View $view,
        Operator $operatorModel
    )
    {
        $this->view = $view;
        $this->operatorModel = $operatorModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $password = password_hash('test',PASSWORD_DEFAULT);
        $json = ' {
    "name": "John",
    "surname": "Operator",
    "email": "pepe@as.com",
    "password": "'. $password .'",
    "join_date": "03-03-1980",
    "operator_level": 3,
    "phone_number": "00447773651107"
  }';
        $operatorData = json_decode($json, true);
      //  $this->operatorModel->insert($operatorData);
        $data = ['data' => $this->operatorModel->findAll()];

        return $this->view->render($response, 'partials/home/index-back.twig', $data);
    }
}