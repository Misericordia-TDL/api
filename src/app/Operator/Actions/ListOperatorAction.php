<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all operators in the platform
 */

namespace App\Operator\Actions;

use App\Operator\Repository\OperatorRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListOperatorAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListOperatorAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var OperatorRepository
     */
    protected $operatorRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param OperatorRepository $operatorRepository
     */
    function __construct(
        View $view,
        OperatorRepository $operatorRepository
    )
    {
        $this->view = $view;
        $this->operatorRepository = $operatorRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $totalPages = $this->operatorRepository->getTotalPages();

        $page = $request->getAttribute('page', 1) <= $totalPages ? $request->getAttribute('page', 1) : 1;

        $data = [
            'operators' => $this->operatorRepository->getAll($page),
            'page' => $page,
            'totalPages' => $totalPages
        ];
        return $this->view->render($response, 'partials/operator/list.twig', $data);
    }
}
