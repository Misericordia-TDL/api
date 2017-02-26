<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;


class ValidationErrorsMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('errors',$_SESSION['errors']);

        unset($_SESSION['errors']);

        $response = $next($request, $response);

        return $response;
    }
}