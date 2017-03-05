<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\OperatorLevel;

use App\Repository\OperatorLevelRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditOperatorLevelAction
 * @package App\Controllers\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditOperatorLevelAction
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
     * EditOperatorLevelAction constructor.
     * @param View $view
     * @param OperatorLevelRepository $operatorLevelRepository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        OperatorLevelRepository $operatorLevelRepository,
        RouterInterface $router
    )
    {
        $this->operatorLevelRepository = $operatorLevelRepository;
        $this->view = $view;
        $this->router = $router;

    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {


        try {
            $id = $request->getAttribute('id');
            $levels = $this->operatorLevelRepository->getAll();

            $operatorLevel = $this->operatorLevelRepository->findById($id);
            $data = [
                'operatorLevel' => $operatorLevel,
                'levels' => $levels,
            ];

            return $this->view->render($response, 'partials/operator-level/edit-operator-level-data.twig', $data);
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-operator-level'));
        }


    }
}