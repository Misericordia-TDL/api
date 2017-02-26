<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Models\Operator;
use App\Models\OperatorLevel;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EditOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditOperatorAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Operator
     */
    private $operatorModel;
    /**
     * @var OperatorLevel
     */
    private $operatorLevel;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param Operator $operatorModel
     * @param OperatorLevel $operatorLevel
     */
    function __construct(
        View $view,
        Operator $operatorModel,
        OperatorLevel $operatorLevel

    )
    {
        $this->operatorModel = $operatorModel;
        $this->operatorLevel = $operatorLevel;
        $this->view = $view;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $levels = $this->operatorLevel->findAll();
        $data = [
            'operator' => $this->operatorModel->findById($id),
            'levels' => $levels,
        ];
        return $this->view->render($response, 'partials/operator/edit-operator-data.twig', $data);
    }
}