<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Food;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Models\Food as FoodModel;

/**
 * Class Food
 * @package Core\Services\Food
 */
class Food implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return FoodModel
         */
        $container['FoodModel'] = function (Container $container): FoodModel {
            $mongoClient = $container['db'];
            $foodCollection = $mongoClient->misericordia->food;
            return new FoodModel($foodCollection);
        };
    }
}