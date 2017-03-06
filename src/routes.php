<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

// Routes

$app->group('', function () {
    $this->get('/', 'HomeIndexAction')->setName('home');
    $this->post('/auth-operator', 'AuthOperatorAction')->setName('auth-operator');

})->add(new GuestMiddleware($container));

$app->group('', function () {

    $this->get('/home', 'HomeLoggedinIndexAction')->setName('home-loggedin');
    $this->get('/refugee', 'RefugeeController:index');
    $this->get('/operator-level', 'OperatorLevelController:index');
    $this->get('/structure', 'StructureController:index')->setName('structure');
    $this->get('/meal', 'MealController:index');
    $this->get('/food', 'FoodController:index');
    $this->get('/medicine', 'MedicineController:index');
    $this->get('/clothe', 'ClotheController:index');
    $this->get('/medical-attention', 'MedicalAttentionController:index');
    $this->get('/logout', 'LogOutOperatorAction')->setName('logout-operator');

})->add(new AuthMiddleware($container));

$app->group('/operator', function () {

    $this->get('', 'OperatorIndexAction')->setName('index-operator');
    $this->get('/create', 'EnterOperatorDataAction')->setName('enter-operator-data');
    $this->post('/create', 'CreateOperatorAction')->setName('create-operator');
    $this->get('/update/{id}', 'EditOperatorAction')->setName('edit-operator');
    $this->post('/update/{id}', 'UpdateOperatorAction')->setName('update-operator');
    $this->post('/delete', 'DeleteOperatorAction')->setName('delete-operator');
    $this->get('/list', 'ListOperatorAction')->setName('list-operator');

})->add(new AuthMiddleware($container));

$app->group('/operator-level', function () {

    $this->get('/create', 'EnterOperatorLevelDataAction')->setName('enter-operator-level-data');
    $this->post('/create', 'CreateOperatorLevelAction')->setName('create-operator-level');
    $this->get('/update/{id}', 'EditOperatorLevelAction')->setName('edit-operator-level');
    $this->post('/update/{id}', 'UpdateOperatorLevelAction')->setName('update-operator-level');
    $this->post('/delete', 'DeleteOperatorLevelAction')->setName('delete-operator-level');
    $this->get('/list', 'ListOperatorLevelAction')->setName('list-operator-level');

})->add(new AuthMiddleware($container));