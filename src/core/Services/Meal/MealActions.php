<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\Meal;

use App\Controllers\MealController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class MealActions
 * @package Core\Services\Meal
 */
class MealActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return MealController
         */
        $container['MealController'] = function (Container $container): MealController {

            return new MealController(
                $container->view,
                $container['MealModel']
            );
        };


    }
}