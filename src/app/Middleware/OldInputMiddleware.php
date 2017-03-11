<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * This middleware will inject submitted form non data for the user to amend it
 */

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class OldInputMiddleware
 * @package App\Middleware
 * @author Javier Mellado <sol@javiermellado.com>
 */
class OldInputMiddleware extends Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    function __invoke(Request $request, Response $response, $next): Response
    {
        $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);

        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}