<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;
use App\Middleware\ValidationErrorsMiddleware;
use App\Middleware\OldInputMiddleware;

// Application middleware

$container = $app->getContainer();

$app->add(new AuthMiddleware($container));
$app->add(new CsrfMiddleware($container));
$app->add(new ValidationErrorsMiddleware($container));
$app->add(new OldInputMiddleware($container));

//$app->add($container->csrf);
