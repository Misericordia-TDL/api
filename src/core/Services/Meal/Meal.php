<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Meal;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Models\Meal as MealModel;

class Meal implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return MealModel
         */
        $container['MealModel'] = function (Container $container): MealModel {
            $mongoClient = $container['db'];
            $mealCollection = $mongoClient->misericordia->meal;
            return new MealModel($mealCollection);
        };
    }
}