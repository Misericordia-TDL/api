<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * Application settings
 *
 * @see https://www.slimframework.com/docs/objects/application.html#application-configuration
 * @author Javier Mellado <sol@javiermellado.com>
 */

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates',
            'debugger' => ['debug' => true]
        ],
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        //database settings
        'db' => [
            'driver' => 'mongodb',
            'host' => 'mongo',
            'port' => 27017,
            'database' => 'misericordia',
//            'username' => '',
//            'password' => '',
            'options' => [
                'database' => 'admin' // sets the authentication database required by mongo 3
            ]
        ],
    ],
];