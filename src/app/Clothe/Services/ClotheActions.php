<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Clothe\Services;

use App\Clothe\Actions\CreateClotheAction;
use App\Clothe\Actions\EnterClotheDataAction;
use App\Clothe\Actions\DeleteClotheAction;
use App\Clothe\Actions\EditClotheAction;
use App\Clothe\Actions\UpdateClotheAction;
use App\Clothe\Actions\ListClotheAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ClotheActions
 * @package Core\Services\Clothe\Actions
 */
class ClotheActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return EditClotheAction
         */
        $container['EditClotheAction'] = function (Container $container): EditClotheAction {

            return new EditClotheAction(
                $container->view,
                $container['ClotheRepository'],
                $container->router
            );
        };

	/**
         * @param Container $container
         * @return UpdateClotheAction
         */
        $container['UpdateClotheAction'] = function (Container $container): UpdateClotheAction {

            return new UpdateClotheAction(
                $container->router,
                $container['validator'],
                $container['ClotheRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return DeleteClotheAction
         */
        $container['DeleteClotheAction'] = function (Container $container): DeleteClotheAction {

            return new DeleteClotheAction(
                $container->router,
                $container['ClotheRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return ListClotheAction
         */
        $container['ListClotheAction'] = function (Container $container): ListClotheAction {

            return new ListClotheAction(
                $container->view,
		$container['ClotheRepository']
		);
        };

        /**
         * @param Container $container
         * @return CreateClotheAction
         */
        $container['CreateClotheAction'] = function (Container $container): CreateClotheAction {

            return new CreateClotheAction(
                $container->router,
                $container['validator'],
                $container['ClotheRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return EnterClotheDataAction
         */
        $container['EnterClotheDataAction'] = function (Container $container): EnterClotheDataAction {

            return new EnterClotheDataAction(
                $container->view
            );
        };
    }
}