<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

// DIC configuration
$container = $app->getContainer();

// view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path']);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

//mongo client
$container['db'] = function ($container) {

    $host = $container['settings']['db']['host'];
    $port = $container['settings']['db']['port'];
    $connectionUri = 'mongodb://' . $host . ':' . $port;
    $dbConnection = new \MongoDB\Client($connectionUri);

    return $dbConnection;
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// UserModel
$container['UserModel'] = function ($container) {

    $mongoClient = $container['db'];
    $usersCollection = $mongoClient->misericordia->users;
    $userModel = new \App\Models\User($usersCollection);

    return $userModel;
};

// UserController
$container['UserController'] = function ($container) {

    return new \App\Controllers\UserController(
        $container->view,
        $container['UserModel']
    );
};