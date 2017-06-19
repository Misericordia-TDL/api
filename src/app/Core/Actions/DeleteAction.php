<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use App\Core\Repository\RepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteAction
 * @package App\Core\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class DeleteAction implements InvokableActionInterface
{
    /**
     * @var string
     */
    protected $element;
    /**
     * @var RepositoryInterface
     */
    protected $repository;
    /**
     * @var RouterInterface
     */
    protected $router;
    /**
     * @var Messages
     */
    protected $flash;

    /**
     * FoodController constructor.
     * @param RouterInterface $router
     * @param RepositoryInterface $repository
     * @param Messages $flash
     */
    function __construct(
        RouterInterface $router,
        RepositoryInterface $repository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        //delete the element and in case of an error, flash message with error message
        //will be sent to the view.
        $flashElement = strtoupper($this->element);
        try {

            if ($this->repository->delete($id)) {
                $this->flash->addMessage('info', $flashElement . ' disabled correctly');
            } else {
                $this->flash->addMessage('error', $flashElement . ' not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', $flashElement . ' not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-' . $this->element));
    }
}