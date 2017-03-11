<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent operator data into a form to be edited
 */

namespace App\Operator\Actions;

use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;
use App\OperatorLevel\Repository\OperatorLevelRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditOperatorAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditOperatorAction
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
     * @var OperatorRepository
     */
    private $operatorRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param OperatorRepository $operatorRepository
     * @param OperatorLevelRepository $operatorLevelRepository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        OperatorRepository $operatorRepository,
        OperatorLevelRepository $operatorLevelRepository,
        RouterInterface $router
    )
    {
        $this->operatorLevelRepository = $operatorLevelRepository;
        $this->operatorRepository = $operatorRepository;
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
        //fetch data from operator
        //In case of operator not found, redirect to list operator action
        try {
            $id = $request->getAttribute('id');
            $levels = $this->operatorLevelRepository->getAll();
            /** @var Operator $operator */
            $operator = $this->operatorRepository->findById($id);
            $data = [
                'operator' => $operator,
                'levels' => $levels,
            ];
            return $this->view->render($response, 'partials/operator/edit-operator-data.twig', $data);
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-operator'));
        }
    }
}