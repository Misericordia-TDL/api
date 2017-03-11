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
use App\Middleware\OldInputMiddleware;
use App\Middleware\ValidationErrorsMiddleware;

// Application middleware

$container = $app->getContainer();

//middleware to protect against cross site request forgery
//@see https://en.wikipedia.org/wiki/Cross-site_request_forgery
$app->add(new CsrfMiddleware($container));

//this middleware will pass the form validation errors from session to the views
//before they get cleared
$app->add(new ValidationErrorsMiddleware($container));

//this middleware will provide the previous form entered data to the views in
//forms with validation errors
$app->add(new OldInputMiddleware($container));

//after all middleware loaded, the csrf package gets added into the app.
$app->add($container['csrf']);
