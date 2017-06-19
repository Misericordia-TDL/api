<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

/**
 * Created by PhpStorm.
 * User: javi
 * Date: 21/05/2017
 * Time: 17:35
 */

namespace App\Core\Traits;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

trait InvokableActionTrait
{
    abstract function __invoke(Request $request, Response $response): ResponseInterface;
}