<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Operator\Actions;

use App\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class LogOutOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class LogOutOperatorAction
{
    /**
     * @var Auth
     */
    protected $auth;
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Auth $auth
     */
    function __construct(
        RouterInterface $router,
        Auth $auth
    )
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        if ($this->auth->check()) {
            unset($_SESSION['operator']);
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }
}