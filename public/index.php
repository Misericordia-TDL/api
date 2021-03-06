<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

declare(strict_types = 1);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
require __DIR__ . '/../vendor/autoload.php';
session_start();
// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
// Set up dependencies
require __DIR__ . '/../src/dependencies.php';
// Register middleware
require __DIR__ . '/../src/middleware.php';
// Register routes.php
require __DIR__ . '/../src/routes.php';
// Run app
/**
 * Workaround to use eloquent outside of laravel
 * @see https://github.com/jenssegers/laravel-mongodb/issues/1037
 */
function app()
{
    return new class()
    {
        public function version()
        {
            return '5.3';
        }
    };
}

$app->run();