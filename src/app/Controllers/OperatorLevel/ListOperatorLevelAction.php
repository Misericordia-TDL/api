<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\OperatorLevel;

use App\Repository\OperatorLevelRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListOperatorLevelAction
 * @package App\Controllers\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListOperatorLevelAction
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
     * IndexAction constructor.
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

        $data = [
            'operatorsLevel' => $this->operatorLevelRepository->getAll()
        ];
        return $this->view->render($response, 'partials/operator-level/list.twig', $data);
    }
}