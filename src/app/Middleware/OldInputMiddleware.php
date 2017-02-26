<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;


class OldInputMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('old',$_SESSION['old']);

        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}