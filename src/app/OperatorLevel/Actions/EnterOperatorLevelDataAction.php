<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EnterOperatorLevelDataAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterOperatorLevelDataAction
{
    /**
     * @var View
     */
    protected $view;

    /**
     * OperatorController constructor.
     * @param View $view
     */
    function __construct(
        View $view
    )
    {
        $this->view = $view;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        return $this->view->render($response, 'partials/operator-level/enter-operator-level-data.twig', []);
    }
}