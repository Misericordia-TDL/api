<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

// DIC configuration
$container = $app->getContainer();

/**
 * @param \Slim\Container $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function (\Slim\Container $container) {
    $settings = $container->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path']);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

/**
 * @param \Slim\Container $container
 * @return \MongoDB\Client
 */
$container['db'] = function (\Slim\Container $container) {

    $host = $container['settings']['db']['host'];
    $port = $container['settings']['db']['port'];
    $connectionUri = 'mongodb://' . $host . ':' . $port;
    $dbConnection = new \MongoDB\Client($connectionUri);

    return $dbConnection;
};

/**
 * @param \Slim\Container $container
 * @return \Monolog\Logger
 */
$container['logger'] = function (\Slim\Container $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Refugee
 */
$container['RefugeeModel'] = function (\Slim\Container $container) {

    $mongoClient = $container['db'];
    $refugeeCollection = $mongoClient->misericordia->refugee;
    return new \App\Models\Refugee($refugeeCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\RefugeeController
 */
$container['RefugeeController'] = function (\Slim\Container $container) {

    return new \App\Controllers\RefugeeController(
        $container->view,
        $container['RefugeeModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Operator
 */
$container['OperatorModel'] = function (\Slim\Container $container) {

    $mongoClient = $container['db'];
    $operatorCollection = $mongoClient->misericordia->operator;
    $userModel = new \App\Models\Operator($operatorCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\OperatorController
 */
$container['OperatorController'] = function (\Slim\Container $container) {

    return new \App\Controllers\OperatorController(
        $container->view,
        $container['OperatorModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\OperatorLevel
 */
$container['OperatorLevelModel'] = function (\Slim\Container $container) {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->Operator_level;
    $userModel = new \App\Models\OperatorLevel($operatorLevelCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\OperatorController
 */
$container['OperatorLevelController'] = function (\Slim\Container $container) {

    return new \App\Controllers\OperatorController(
        $container->view,
        $container['OperatorLevel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Structure
 */
$container['StructureModel'] = function (\Slim\Container $container) {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->structure;
    $structureModel = new \App\Models\Structure($operatorLevelCollection);

    return $structureModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\StructureController
 */
$container['StructureController'] = function (\Slim\Container $container) {

    return new \App\Controllers\StructureController(
        $container->view,
        $container['StructureModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Meal
 */
$container['MealModel'] = function (\Slim\Container $container) {
    $mongoClient = $container['db'];
    $mealCollection = $mongoClient->misericordia->meal;
    return new \App\Models\Meal($mealCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MealController
 */
$container['MealController'] = function (\Slim\Container $container) {

    return new \App\Controllers\MealController(
        $container->view,
        $container['MealModel']
    );
};