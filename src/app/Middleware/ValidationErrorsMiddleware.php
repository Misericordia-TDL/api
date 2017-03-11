<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This middleware will collect all form error messages and inject them into the views
 */

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ValidationErrorsMiddleware
 * @package App\Middleware
 * @author Javier Mellado <sol@javiermellado.com>
 */
class ValidationErrorsMiddleware extends Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    function __invoke(Request $request, Response $response, $next): Response
    {
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);

        unset($_SESSION['errors']);

        $response = $next($request, $response);

        return $response;
    }
}