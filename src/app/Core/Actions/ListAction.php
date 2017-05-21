<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use App\Core\Repository\RepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class ListAction implements InvokableActionInterface
{
    /**
     * @var string
     */
    protected $listElements;
    /**
     * @var  string
     */
    protected $template;
    /**
     * @var View
     */
    protected $view;
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param RepositoryInterface $repository
     */
    function __construct(
        View $view,
        RepositoryInterface $repository
    )
    {
        $this->view = $view;
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $totalPages = $this->repository->getTotalPages();

        $page = $request->getAttribute('page', 1) <= $totalPages ? $request->getAttribute('page', 1) : 1;

        $data = [
            $this->listElements => $this->repository->getAll($page),
            'page' => $page,
            'totalPages' => $totalPages
        ];
        return $this->view->render($response, $this->template, $data);
    }
}