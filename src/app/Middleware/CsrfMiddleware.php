<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;


class CsrfMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('csrf',[
            'field' => '
                <input type="hidden" 
                name="'. $this->container->csrf->getTokenNameKey() .'" 
                value="'. $this->container->csrf->getTokenName() .'">
                <input type="hidden" 
                name="'. $this->container->csrf->getTokenValueKey() .'" 
                value="'. $this->container->csrf->getTokenValue() .'">
            '
        ]);


        $response = $next($request, $response);

        return $response;
    }
}