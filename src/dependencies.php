<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

use Respect\Validation\Validator;
use App\Core\Services\Common as CommonServices;
use App\Operator\Services\Operator as Operator;
use App\Operator\Services\OperatorActions;
use App\OperatorLevel\Services\OperatorLevel;
use App\OperatorLevel\Services\OperatorLevelActions;
use App\Home\Services\Home;
use App\Home\Services\HomeActions;
use Illuminate\Database\Capsule\Manager;
use Jenssegers\Mongodb\Connection;
// DIC configuration
$container = $app->getContainer();

//ACTIONS
Validator::with('App\\Validation\\Rules');

$container->register(new CommonServices());
$container->register(new Operator());
$container->register(new OperatorActions());
$container->register(new OperatorLevel());
$container->register(new OperatorLevelActions());
$container->register(new Home());
$container->register(new HomeActions());

//Setup eloquent for mongodb to work
$capsule = new Manager();
$capsule->getDatabaseManager()->extend('mongodb', function($config)
{
    return new Connection($config);
});

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();