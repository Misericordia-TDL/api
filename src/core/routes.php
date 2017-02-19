<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * @author Javier Mellado <sol@javiermellado.com>
 */

// Routes
$app->get('/refugee', 'RefugeeController:index');
$app->get('/operator', 'OperatorController:index');
$app->get('/operator-level', 'OperatorLevelController:index');
$app->get('/structure', 'StructureController:index');
$app->get('/meal', 'MealController:index');
$app->get('/food', 'FoodController:index');
$app->get('/medicine', 'MedicineController:index');
$app->get('/clothe', 'ClotheController:index');