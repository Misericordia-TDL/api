<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

use Slim\Container;
use MongoDB\Client;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Models\Clothe;
use App\Models\Food;
use App\Models\Meal;
use App\Models\MedicalAttention;
use App\Models\Medicine;
use App\Models\Operator;
use App\Models\OperatorLevel;
use App\Models\Refugee;
use App\Models\Structure;
use App\Controllers\ClotheController;
use App\Controllers\FoodController;
use App\Controllers\MealController;
use App\Controllers\MedicalAttentionController;
use App\Controllers\MedicineController;
use App\Controllers\OperatorLevelController;
use App\Controllers\StructureController;
use App\Controllers\RefugeeController;
use App\Controllers\Home\IndexAction;
use App\Controllers\Home\IndexLoggedAction;
use App\Controllers\Operator\AuthOperatorAction;
use App\Controllers\Operator\LogOutOperatorAction;
use App\Controllers\Operator\CreateOperatorAction;
use App\Auth\Auth;
use Slim\Csrf\Guard;
use App\Validation\Validator;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
// DIC configuration
$container = $app->getContainer();


$container['auth'] = function (Container $container): Auth {

    return new Auth($container['OperatorModel']);
};

/**
 * @param \Slim\Container $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function (Container $container): \Slim\Views\Twig {
    $settings = $container->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path'], $settings['debugger']);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('flash', $container->flash);
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user'  => $container->auth->user()
    ]);
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

/**
 * @param \Slim\Container $container
 * @return \MongoDB\Client
 */
$container['db'] = function (Container $container): Client {

    $host = $container['settings']['db']['host'];
    $port = $container['settings']['db']['port'];
    $connectionUri = 'mongodb://' . $host . ':' . $port;
    $dbConnection = new Client($connectionUri);

    return $dbConnection;
};

/**
 * @param \Slim\Container $container
 * @return Logger
 */
$container['logger'] = function (Container $container): Logger {
    $settings = $container->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Refugee
 */
$container['RefugeeModel'] = function (Container $container): Refugee {

    $mongoClient = $container['db'];
    $refugeeCollection = $mongoClient->misericordia->refugee;
    return new Refugee($refugeeCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\RefugeeController
 */
$container['RefugeeController'] = function (Container $container): RefugeeController {

    return new RefugeeController(
        $container->view,
        $container['RefugeeModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Operator
 */
$container['OperatorModel'] = function (Container $container): Operator {

    $mongoClient = $container['db'];
    $operatorCollection = $mongoClient->misericordia->operator;
    $userModel = new Operator($operatorCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\OperatorLevel
 */
$container['OperatorLevelModel'] = function (Container $container): OperatorLevel {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->operator_level;
    $userModel = new OperatorLevel($operatorLevelCollection);

    return $userModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\OperatorLevelController
 */
$container['OperatorLevelController'] = function (Container $container): OperatorLevelController {

    return new OperatorLevelController(
        $container->view,
        $container['OperatorLevelModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Structure
 */
$container['StructureModel'] = function (Container $container): Structure {
    $mongoClient = $container['db'];
    $operatorLevelCollection = $mongoClient->misericordia->structure;
    $structureModel = new Structure($operatorLevelCollection);

    return $structureModel;
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\StructureController
 */
$container['StructureController'] = function (Container $container): StructureController {

    return new StructureController(
        $container->view,
        $container['StructureModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Meal
 */
$container['MealModel'] = function (Container $container): Meal {
    $mongoClient = $container['db'];
    $mealCollection = $mongoClient->misericordia->meal;
    return new Meal($mealCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MealController
 */
$container['MealController'] = function (Container $container): MealController {

    return new MealController(
        $container->view,
        $container['MealModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Food
 */
$container['FoodModel'] = function (Container $container): Food {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->food;
    return new Food($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\FoodController
 */
$container['FoodController'] = function (Container $container): FoodController {

    return new FoodController(
        $container->view,
        $container['FoodModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Medicine
 */
$container['MedicineModel'] = function (Container $container): Medicine {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->medicine;
    return new Medicine($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MedicineController
 */
$container['MedicineController'] = function (Container $container): MedicineController {

    return new MedicineController(
        $container->view,
        $container['MedicineModel']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Models\Clothe
 */
$container['ClotheModel'] = function (Container $container): Clothe {
    $mongoClient = $container['db'];
    $foodCollection = $mongoClient->misericordia->clothe;
    return new Clothe($foodCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\ClotheController
 */
$container['ClotheController'] = function (Container $container): ClotheController {

    return new ClotheController(
        $container->view,
        $container['ClotheModel']
    );
};
/**
 * @param \Slim\Container $container
 * @return \App\Models\MedicalAttention
 */
$container['MedicalAttentionModel'] = function (Container $container): MedicalAttention {
    $mongoClient = $container['db'];
    $medicalAttentionCollection = $mongoClient->misericordia->medical_attention;
    return new MedicalAttention($medicalAttentionCollection);
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\MedicalAttentionController
 */
$container['MedicalAttentionController'] = function (Container $container): MedicalAttentionController {

    return new MedicalAttentionController(
        $container->view,
        $container['MedicalAttentionModel']
    );
};


$container['csrf'] = function (Container $container): Guard {
    return new Guard();
};
$container['validator'] = function (Container $container): Validator {
    return new Validator();
};
$container['flash'] = function (Container $container): Messages {
    return new Messages;
};
//ACTIONS
/**
 * @param \Slim\Container $container
 * @return \App\Controllers\Home\IndexAction
 */
$container['HomeIndexAction'] = function (Container $container): IndexAction {

    return new IndexAction(
        $container->view
    );
};
/**
 * @param \Slim\Container $container
 * @return \App\Controllers\Home\IndexLoggedAction
 */
$container['HomeLoggedinIndexAction'] = function (Container $container): IndexLoggedAction {

    return new IndexLoggedAction(
        $container->view,
        $container['auth']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\Operator\CreateOperatorAction
 */
$container['CreateOperatorAction'] = function (Container $container): CreateOperatorAction {

    return new CreateOperatorAction(
        $container->view,
        $container['OperatorModel']
    );
};
/**
 * @param \Slim\Container $container
 * @return \App\Controllers\Operator\AuthOperatorAction
 */
$container['AuthOperatorAction'] = function (Container $container): AuthOperatorAction {

    return new AuthOperatorAction(
        $container->router,
        $container['auth'],
        $container['validator'],
        $container['OperatorModel'],
        $container['flash']
    );
};

/**
 * @param \Slim\Container $container
 * @return \App\Controllers\Operator\LogOutOperatorAction
 */
$container['LogOutOperatorAction'] = function (Container $container): LogOutOperatorAction {

    return new LogOutOperatorAction(
        $container->router,
        $container['auth']
    );
};

v::with('App\\Validation\\Rules');