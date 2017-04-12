<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * In this file all the routes of the application will be configured
 * each route corresponds with an action. Each entry point has a unique task
 *
 * @see https://www.slimframework.com/docs/objects/router.html
 * @author Javier Mellado <sol@javiermellado.com>
 */

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

// Routes

// Routes for logged out functionality
$app->group('', function () {
    $this->get('/', 'HomeIndexAction')->setName('home');
    $this->post('/auth-operator', 'AuthOperatorAction')->setName('auth-operator');
    $this->get('/reset-password', 'EnterResetPasswordEmailAction')->setName('enter-restore-password-email');
    $this->post('/reset-password', 'ResetPasswordAction')->setName('reset-password');
    $this->get('/enter-new-password/{token}', 'EnterNewPasswordAction')->setName('enter-new-password');
    $this->post('/enter-new-password/{token}', 'SaveNewPasswordAction')->setName('save-new-password');
})->add(new GuestMiddleware($container));

// Routes for authenticated users
$app->group('', function () {

    $this->get('/home', 'HomeLoggedinIndexAction')->setName('home-loggedin');
    $this->get('/logout', 'LogOutOperatorAction')->setName('logout-operator');

})->add(new AuthMiddleware($container));

// All routes of the operator module
$app->group('/operator', function () {

    $this->get('', 'OperatorIndexAction')->setName('index-operator');
    $this->get('/create', 'EnterOperatorDataAction')->setName('enter-operator-data');
    $this->post('/create', 'CreateOperatorAction')->setName('create-operator');
    $this->get('/update/{id}', 'EditOperatorAction')->setName('edit-operator');
    $this->post('/update/{id}', 'UpdateOperatorAction')->setName('update-operator');
    $this->post('/delete', 'DeleteOperatorAction')->setName('delete-operator');
    $this->get('/list[/{page}]', 'ListOperatorAction')->setName('list-operator');

})->add(new AuthMiddleware($container));

// All routes of the operator level module
$app->group('/operator-level', function () {

    $this->get('/create', 'EnterOperatorLevelDataAction')->setName('enter-operator-level-data');
    $this->post('/create', 'CreateOperatorLevelAction')->setName('create-operator-level');
    $this->get('/update/{id}', 'EditOperatorLevelAction')->setName('edit-operator-level');
    $this->post('/update/{id}', 'UpdateOperatorLevelAction')->setName('update-operator-level');
    $this->post('/delete', 'DeleteOperatorLevelAction')->setName('delete-operator-level');
    $this->get('/list', 'ListOperatorLevelAction')->setName('list-operator-level');

})->add(new AuthMiddleware($container));

// Index route for inventory module
$app->group('/inventory', function () {
    $this->get('', 'InventoryIndexAction')->setName('index-inventory');
})->add(new AuthMiddleware($container));

// All routes of the food module
$app->group('/food', function () {

    $this->get('/create', 'EnterFoodDataAction')->setName('enter-food-data');
    $this->post('/create', 'CreateFoodAction')->setName('create-food');
    $this->get('/update/{id}', 'EditFoodAction')->setName('edit-food');
    $this->post('/update/{id}', 'UpdateFoodAction')->setName('update-food');
    $this->post('/delete', 'DeleteFoodAction')->setName('delete-food');
    $this->get('/list', 'ListFoodAction')->setName('list-food');

})->add(new AuthMiddleware($container));

// All routes of the clothe module
$app->group('/clothing', function () {

    $this->get('/create', 'EnterClotheDataAction')->setName('enter-clothe-data');
    $this->post('/create', 'CreateClotheAction')->setName('create-clothe');
    $this->get('/update/{id}', 'EditClotheAction')->setName('edit-clothe');
    $this->post('/update/{id}', 'UpdateClotheAction')->setName('update-clothe');
    $this->post('/delete', 'DeleteClotheAction')->setName('delete-clothe');
    $this->get('/list', 'ListClotheAction')->setName('list-clothe');

})->add(new AuthMiddleware($container));

// All routes of the medicine module
$app->group('/medicine', function () {

    $this->get('/create', 'EnterMedicineDataAction')->setName('enter-medicine-data');
    $this->post('/create', 'CreateMedicineAction')->setName('create-medicine');
    $this->get('/update/{id}', 'EditMedicineAction')->setName('edit-medicine');
    $this->post('/update/{id}', 'UpdateMedicineAction')->setName('update-medicine');
    $this->post('/delete', 'DeleteMedicineAction')->setName('delete-medicine');
    $this->get('/list', 'ListMedicineAction')->setName('list-medicine');

})->add(new AuthMiddleware($container));

