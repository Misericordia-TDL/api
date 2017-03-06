<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class GuestMiddleware
 * @package App\Middleware
 */
class GuestMiddleware extends Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    function __invoke(Request $request, Response $response, $next): Response
    {

        if ($this->container->auth->check()) {
            return $response->withRedirect($this->container->router->pathFor('home-loggedin'));
        }


        $response = $next($request, $response);

        return $response;
    }
}