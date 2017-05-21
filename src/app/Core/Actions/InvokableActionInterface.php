<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Interface InvokableActionInterface
 * @package App\Core\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
interface InvokableActionInterface
{
    function __invoke(Request $request, Response $response): ResponseInterface;
}