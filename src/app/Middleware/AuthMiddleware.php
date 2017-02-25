<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        return $response;
    }
}