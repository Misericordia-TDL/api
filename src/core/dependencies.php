<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

use Slim\Container;
use App\Controllers\Home\IndexAction;
use App\Controllers\Home\IndexLoggedAction;
use Respect\Validation\Validator;
use Core\Services\Common as CommonServices;
use Core\Services\Operator\Operator as Operator;
use Core\Services\Operator\OperatorActions;
use Core\Services\OperatorLevel\OperatorLevel;
use Core\Services\OperatorLevel\OperatorLevelActions;
use Core\Services\Refugee\Refugee;
use Core\Services\Refugee\RefugeeActions;
use Core\Services\Structure\Structure;
use Core\Services\Structure\StructureActions;
use Core\Services\Meal\Meal;
use Core\Services\Meal\MealActions;
use Core\Services\Food\Food;
use Core\Services\Food\FoodActions;
use Core\Services\Medicine\Medicine;
use Core\Services\Medicine\MedicineActions;
use Core\Services\Clothe\Clothe;
use Core\Services\Clothe\ClotheActions;

// DIC configuration
$container = $app->getContainer();






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
$container->register(new Operator());
$container->register(new OperatorActions());
$container->register(new OperatorLevel());
$container->register(new OperatorLevelActions());
$container->register(new Refugee());
$container->register(new RefugeeActions());
$container->register(new Structure());
$container->register(new StructureActions());
$container->register(new Meal());
$container->register(new MealActions());
$container->register(new Food());
$container->register(new FoodActions());
$container->register(new Medicine());
$container->register(new MedicineActions());
$container->register(new Clothe());
$container->register(new ClotheActions());