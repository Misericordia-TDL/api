<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;

class GuestMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {

        if ($this->container->auth->check()) {
            return $response->withRedirect($this->container->router->pathFor('home-loggedin'));
        }


        $response = $next($request, $response);

        return $response;
    }
}