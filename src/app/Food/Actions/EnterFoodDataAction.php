<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will create a valid new food form to be added to the food collection
 */

namespace App\Food\Actions;

use App\Core\Actions\EnterDataAction;

/**
 * Class EnterFoodDataAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EnterFoodDataAction extends EnterDataAction
{
    protected $template = 'partials/food/enter-food-data.twig';
}
