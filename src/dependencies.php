<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * In this class is where all the component dependencies of the application will be loaded
 * whether is coming from a package imported via composer like Capsule or Eloquent
 * or an custom application module like Operator or OperatorLevel
 *
 * @see https://www.slimframework.com/docs/concepts/di.html
 * @author Javier Mellado <sol@javiermellado.com>
 */

use App\Core\Services\Common as CommonServices;
use App\Home\Services\Home as HomeService;
use App\Home\Services\HomeActions as HomeActionsService;
use App\Operator\Services\Operator as OperatorService;
use App\Operator\Services\OperatorActions as OperatorActionsService;
use App\OperatorLevel\Services\OperatorLevel as OperatorLevelService;
use App\OperatorLevel\Services\OperatorLevelActions as OperatorLevelActionsService;
use App\Inventory\Services\InventoryActions as InventoryActionsService;
use App\Food\Services\FoodActions as FoodActionsService;
use App\Food\Services\Food as FoodService;
use App\Clothe\Services\ClotheActions as ClotheActionsService;
use App\Clothe\Services\Clothe as ClotheService;
use App\Medicine\Services\MedicineActions as MedicineActionsService;
use App\Medicine\Services\Medicine as MedicineService;
use Illuminate\Database\Capsule\Manager;
use Jenssegers\Mongodb\Connection;
use Respect\Validation\Validator;

// DIC configuration
$container = $app->getContainer();

//Here we load all the Validation rules that will be used in actions
Validator::with('App\\Validation\\Rules');

//Here all the dependencies get registered
$container->register(new CommonServices());
$container->register(new OperatorService());
$container->register(new OperatorActionsService());
$container->register(new OperatorLevelService());
$container->register(new OperatorLevelActionsService());
$container->register(new FoodService());
$container->register(new FoodActionsService());
$container->register(new ClotheService());
$container->register(new ClotheActionsService());
$container->register(new MedicineService());
$container->register(new MedicineActionsService());
$container->register(new InventoryActionsService());
$container->register(new HomeService());
$container->register(new HomeActionsService());

//Setup eloquent for mongodb to work
$capsule = new Manager();
$capsule->getDatabaseManager()->extend('mongodb', function ($config) {
    return new Connection($config);
});

//setup eloquent to kick in when application runs
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();