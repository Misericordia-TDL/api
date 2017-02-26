<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */


// Routes

$app->get('/', 'HomeIndexAction')->setName('home');
$app->get('/refugee', 'RefugeeController:index');
$app->post('/create-operator', 'CreateOperatorAction')->setName('create-operator');
$app->post('/auth-operator', 'AuthOperatorAction')->setName('auth-operator');
$app->get('/operator-level', 'OperatorLevelController:index');
$app->get('/logout-operator', 'LogOutOperatorAction')->setName('logout-operator');
$app->get('/structure', 'StructureController:index');
$app->get('/meal', 'MealController:index');
$app->get('/food', 'FoodController:index');
$app->get('/medicine', 'MedicineController:index');
$app->get('/clothe', 'ClotheController:index');
$app->get('/medical-attention', 'MedicalAttentionController:index');