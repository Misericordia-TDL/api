<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Home;

use App\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class IndexAction
 * @package App\Controllers\Home
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class IndexLoggedAction
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
     * IndexAction constructor.
     * @param View $view
     * @param Auth $auth
     */
    function __construct(
        View $view,
        Auth $auth
    )
    {
        $this->view = $view;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $authCheck = $this->auth->check();
        $data = ['auth' => $authCheck];
        if ($authCheck) {
            $data['user'] = $this->auth->user();
        }
        return $this->view->render($response, 'partials/home/index.twig', $data);
    }
}