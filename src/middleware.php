<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * In this class is where all the middlewares of the application will be loaded.
 *
 * @see https://www.slimframework.com/docs/concepts/middleware.html
 * @author Javier Mellado <sol@javiermellado.com>
 */

use App\Middleware\CsrfMiddleware;
use App\Middleware\ValidationErrorsMiddleware;
use App\Middleware\OldInputMiddleware;

// Application middleware

$container = $app->getContainer();

$app->add(new CsrfMiddleware($container));
$app->add(new ValidationErrorsMiddleware($container));
$app->add(new OldInputMiddleware($container));

$app->add($container->csrf);
