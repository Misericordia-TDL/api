<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Auth\Auth;
use App\OperatorLevel\Repository\OperatorLevelRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteOperatorLevelAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteOperatorLevelAction
{
    /**
     * @var OperatorLevelRepository
     */
    protected $operatorLevelRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Messages
     */
    private $flash;
    /**
     * @var Auth
     */
    private $auth;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Auth $auth
     * @param OperatorLevelRepository $operatorLevelRepository
     * @param Messages $flash
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Auth $auth,
        OperatorLevelRepository $operatorLevelRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->operatorLevelRepository = $operatorLevelRepository;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        try {

            if ($this->operatorLevelRepository->delete($id)) {
                $this->flash->addMessage('info', 'Operator disabled correctly');
            } else {
                $this->flash->addMessage('error', 'Operator not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Operator not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-operator-level'));
    }
}