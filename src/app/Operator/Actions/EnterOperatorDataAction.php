<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will create a valid new operator form to be added to the operator collection
 */

namespace App\Operator\Actions;

use App\OperatorLevel\Repository\OperatorLevelRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EnterOperatorDataAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterOperatorDataAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var OperatorLevelRepository
     */
    protected $operatorLevelRepository;

    /**
     * OperatorController constructor.
     * @param View $view
     * @param OperatorLevelRepository $operatorLevelRepository
     */
    function __construct(
        View $view,
        OperatorLevelRepository $operatorLevelRepository
    )
    {
        $this->view = $view;
        $this->operatorLevelRepository = $operatorLevelRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $levels = $this->operatorLevelRepository->getAll();
        $data = [
            'levels' => $levels
        ];
        return $this->view->render($response, 'partials/operator/enter-operator-data.twig', $data);
    }
}