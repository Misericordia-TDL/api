<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use App\Core\Repository\RepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditAction
 * @package App\Core\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class EditAction implements InvokableActionInterface
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var  string
     */
    protected $template;
    /**
     * @var  string
     */
    protected $element;
    /**
     * @var RouterInterface
     */
    protected $router;
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param RepositoryInterface $repository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        RepositoryInterface $repository,
        RouterInterface $router
    )
    {
        $this->repository = $repository;
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
        //fetch data from food
        //In case of element not found, redirect to list action
        try {
            $id = $request->getAttribute('id');
            $element = $this->repository->findById($id);
            $data = [
                $this->element => $element,
            ];
            return $this->view->render(
                $response,
                $this->template,
                $data
            );
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-' . $this->element));
        }
    }
}