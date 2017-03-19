<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Food\Services;

use App\Food\Actions\ListFoodAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class FoodActions
 * @package Core\Services\Food\Actions
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
         * @return ListFoodAction
         */
        $container['ListFoodAction'] = function (Container $container): ListFoodAction {

            return new ListFoodAction(
                $container->view,
		$container['FoodRepository']
		);
        };
    }
}