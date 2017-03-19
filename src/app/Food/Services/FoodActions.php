<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Food\Services;

use App\Food\Actions\DeleteFoodAction;
use App\Food\Actions\EditFoodAction;
use App\Food\Actions\UpdateFoodAction;
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
         * @return EditFoodAction
         */
        $container['EditFoodAction'] = function (Container $container): EditFoodAction {

            return new EditFoodAction(
                $container->view,
                $container['FoodRepository'],
                $container->router
            );
        };

	/**
         * @param Container $container
         * @return UpdateFoodAction
         */
        $container['UpdateFoodAction'] = function (Container $container): UpdateFoodAction {

            return new UpdateFoodAction(
                $container->router,
                $container['validator'],
                $container['FoodRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return DeleteFoodAction
         */
        $container['DeleteFoodAction'] = function (Container $container): DeleteFoodAction {

            return new DeleteFoodAction(
                $container->router,
                $container['FoodRepository'],
                $container['flash']
            );
        };

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