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
$container['view'] = function (\Slim\Container $container): \Slim\Views\Twig {
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
$container['db'] = function (\Slim\Container $container): \MongoDB\Client {

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
$container['logger'] = function (\Slim\Container $container): \Monolog\Logger {
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
$container['RefugeeModel'] = function (\Slim\Container $container): \App\Models\Refugee {

    $mongoClient = $container['db'];
    $refugeeCollection = $mongoClient->misericordia->refugee;
    return new \App\Models\Refugee($refugeeCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\RefugeeController
 */
$container['RefugeeController'] = function (\Slim\Container $container): \App\Controllers\RefugeeController {

    return new \App\Controllers\RefugeeController(
        $container->view,
        $container['RefugeeModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Operator
 */
$container['OperatorModel'] = function (\Slim\Container $container): \App\Models\Operator {

    $mongoClient = $container['db'];
    $operatorCollection = $mongoClient->misericordia->operator;
    $userModel = new \App\Models\Operator($operatorCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\OperatorController
 */
$container['OperatorController'] = function (\Slim\Container $container): \App\Controllers\OperatorController {

    return new \App\Controllers\OperatorController(
        $container->view,
        $container['OperatorModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\OperatorLevel
 */
$container['OperatorLevelModel'] = function (\Slim\Container $container): \App\Models\OperatorLevel {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->operator_level;
    $userModel = new \App\Models\OperatorLevel($operatorLevelCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\OperatorLevelController
 */
$container['OperatorLevelController'] = function (\Slim\Container $container): \App\Controllers\OperatorLevelController {

    return new \App\Controllers\OperatorLevelController(
        $container->view,
        $container['OperatorLevelModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Structure
 */
$container['StructureModel'] = function (\Slim\Container $container): \App\Models\Structure {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->structure;
    $structureModel = new \App\Models\Structure($operatorLevelCollection);

    return $structureModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\StructureController
 */
$container['StructureController'] = function (\Slim\Container $container): \App\Controllers\StructureController {

    return new \App\Controllers\StructureController(
        $container->view,
        $container['StructureModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Meal
 */
$container['MealModel'] = function (\Slim\Container $container): \App\Models\Meal {
    $mongoClient = $container['db'];
    $mealCollection = $mongoClient->misericordia->meal;
    return new \App\Models\Meal($mealCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MealController
 */
$container['MealController'] = function (\Slim\Container $container): \App\Controllers\MealController {

    return new \App\Controllers\MealController(
        $container->view,
        $container['MealModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Food
 */
$container['FoodModel'] = function (\Slim\Container $container): \App\Models\Food {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->food;
    return new \App\Models\Food($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\FoodController
 */
$container['FoodController'] = function (\Slim\Container $container): \App\Controllers\FoodController {

    return new \App\Controllers\FoodController(
        $container->view,
        $container['FoodModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Medicine
 */
$container['MedicineModel'] = function (\Slim\Container $container): \App\Models\Medicine {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->medicine;
    return new \App\Models\Medicine($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MedicineController
 */
$container['MedicineController'] = function (\Slim\Container $container): \App\Controllers\MedicineController {

    return new \App\Controllers\MedicineController(
        $container->view,
        $container['MedicineModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Clothe
 */
$container['ClotheModel'] = function (\Slim\Container $container): \App\Models\Clothe {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->clothe;
    return new \App\Models\Clothe($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\ClotheController
 */
$container['ClotheController'] = function (\Slim\Container $container): \App\Controllers\ClotheController {

    return new \App\Controllers\ClotheController(
        $container->view,
        $container['ClotheModel']
    );
};
/**
 * @param \Slim\Container $container
 * @return \App\Models\MedicalAttention
 */
$container['MedicalAttentionModel'] = function (\Slim\Container $container): \App\Models\MedicalAttention {
    $mongoClient = $container['db'];
    $medicalAttentionCollection = $mongoClient->misericordia->medical_attention;
    return new \App\Models\MedicalAttention($medicalAttentionCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MedicalAttentionController
 */
$container['MedicalAttentionController'] = function (\Slim\Container $container): \App\Controllers\MedicalAttentionController {

    return new \App\Controllers\MedicalAttentionController(
        $container->view,
        $container['MedicalAttentionModel']
    );
};