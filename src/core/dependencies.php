<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

use Slim\Container;
use App\Models\Clothe;
use App\Models\Food;
use App\Models\Meal;
use App\Models\MedicalAttention;
use App\Models\Medicine;
use App\Models\Operator;
use App\Models\Refugee;
use App\Models\Structure;
use App\Controllers\ClotheController;
use App\Controllers\FoodController;
use App\Controllers\MealController;
use App\Controllers\MedicalAttentionController;
use App\Controllers\MedicineController;
use App\Controllers\StructureController;
use App\Controllers\RefugeeController;
use App\Controllers\Home\IndexAction;
use App\Controllers\Home\IndexLoggedAction;
use Respect\Validation\Validator;
use Core\Services\Common as CommonServices;
use Core\Services\Operator\Operator as OperatorModel;
use Core\Services\Operator\OperatorActions;
use Core\Services\OperatorLevel\OperatorLevel;
use Core\Services\OperatorLevel\OperatorLevelActions;

// DIC configuration
$container = $app->getContainer();

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

Validator::with('App\\Validation\\Rules');

$container->register(new CommonServices());
$container->register(new OperatorModel());
$container->register(new OperatorActions());
$container->register(new OperatorLevel());
$container->register(new OperatorLevelActions());