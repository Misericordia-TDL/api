<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Operator;

use App\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Route;
use Slim\Views\Twig as View;

/**
 * Class AuthOperatorAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class AuthOperatorAction
{
    /**
     * @var View
     */
    protected $view;
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
     * @param View $view
     * @param RouterInterface $router
     * @param Auth $auth
     */
    function __construct(
        View $view,
        RouterInterface $router,
        Auth $auth
    )
    {
        $this->view = $view;
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
        $email = $request->getParam('email');
        $password = $request->getParam('password');

        $this->auth->attempt($email, $password);

        return $response->withRedirect($this->router->pathFor('home'));
    }
}