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
    $this->get('/operator', 'OperatorIndexAction')->setName('index-operator');
    $this->get('/operator/add', 'EnterOperatorDataAction')->setName('enter-operator-data');
    $this->get('/operator/list', 'ListOperatorAction')->setName('list-operator');
    $this->get('/operator/edit/{id}', 'EditOperatorAction')->setName('edit-operator');
    $this->get('/operator/logout', 'LogOutOperatorAction')->setName('logout-operator');
    $this->post('/operator/create', 'CreateOperatorAction')->setName('create-operator');
    $this->post('/operator/update', 'UpdateOperatorAction')->setName('update-operator');
    $this->post('/operator/delete', 'DeleteOperatorAction')->setName('delete-operator');
    $this->get('/refugee', 'RefugeeController:index');
    $this->get('/operator-level', 'OperatorLevelController:index');
    $this->get('/structure', 'StructureController:index')->setName('structure');
    $this->get('/meal', 'MealController:index');
    $this->get('/food', 'FoodController:index');
    $this->get('/medicine', 'MedicineController:index');
    $this->get('/clothe', 'ClotheController:index');
    $this->get('/medical-attention', 'MedicalAttentionController:index');

})->add(new AuthMiddleware($container));