<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * This middleware will inject a csrf fields to the application forms
 *
 * @see https://en.wikipedia.org/wiki/Cross-site_request_forgery
 */

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CsrfMiddleware
 * @package App\Middleware
 * @author Javier Mellado <sol@javiermellado.com>
 */
class CsrfMiddleware extends Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    function __invoke(Request $request, Response $response, $next): Response
    {
        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" 
                name="' . $this->container->csrf->getTokenNameKey() . '" 
                value="' . $this->container->csrf->getTokenName() . '">
                <input type="hidden" 
                name="' . $this->container->csrf->getTokenValueKey() . '" 
                value="' . $this->container->csrf->getTokenValue() . '">
            '
        ]);


        $response = $next($request, $response);

        return $response;
    }
}