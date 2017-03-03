<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Food;


use App\Controllers\FoodController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class FoodActions
 * @package Core\Services\Food
 */
class FoodActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return FoodController
         */
        $container['FoodController'] = function (Container $container): FoodController {

            return new FoodController(
                $container->view,
                $container['FoodModel']
            );
        };

    }
}