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
 * Class ListOperatorAction
 * @package App\Controllers\Home
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListOperatorAction
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
     * IndexAction constructor.
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

        $data = [
            'operators' => $this->operatorModel->getAll()
        ];
        return $this->view->render($response, 'partials/operator/list.twig', $data);
    }
}