<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Models\Eloquent\OperatorRepository;
use App\Models\Operator;
use App\Models\OperatorLevel;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
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
     * @var OperatorRepository
     */
    private $operatorRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param OperatorRepository $operatorRepository
     * @param OperatorLevel $operatorLevel
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        OperatorRepository $operatorRepository,
        OperatorLevel $operatorLevel,
        RouterInterface $router
    )
    {
        $this->operatorLevel = $operatorLevel;
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
        $id = $request->getAttribute('id');
        $levels = $this->operatorLevel->findAll();

        $operator = $this->operatorRepository->findById($id);
        if (!$operator) return $response->withRedirect($this->router->pathFor('list-operator'));

        $data = [
            'operator' => $operator,
            'levels' => $levels,
        ];

        return $this->view->render($response, 'partials/operator/edit-operator-data.twig', $data);

    }
}