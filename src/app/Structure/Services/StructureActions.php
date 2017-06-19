<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Services;

use App\Structure\Actions\CreateStructureAction;
use App\Structure\Actions\DeleteStructureAction;
use App\Structure\Actions\EditStructureAction;
use App\Structure\Actions\EnterStructureDataAction;
use App\Structure\Actions\ListStructureAction;
use App\Structure\Actions\UpdateStructureAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class StructureActions
 * @package Core\Services\Structure\Actions
 */
class StructureActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return \App\Structure\Actions\EditStructureAction
         */
        $container['EditStructureAction'] = function (Container $container): EditStructureAction {

            return new EditStructureAction(
                $container->view,
                $container['StructureRepository'],
                $container->router
            );
        };

        /**
         * @param Container $container
         * @return UpdateStructureAction
         */
        $container['UpdateStructureAction'] = function (Container $container): UpdateStructureAction {

            return new UpdateStructureAction(
                $container->router,
                $container['validator'],
                $container['StructureRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return DeleteStructureAction
         */
        $container['DeleteStructureAction'] = function (Container $container): DeleteStructureAction {

            return new DeleteStructureAction(
                $container->router,
                $container['StructureRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return ListStructureAction
         */
        $container['ListStructureAction'] = function (Container $container): ListStructureAction {

            return new ListStructureAction(
                $container->view,
                $container['StructureRepository']
            );
        };

        /**
         * @param Container $container
         * @return CreateStructureAction
         */
        $container['CreateStructureAction'] = function (Container $container): CreateStructureAction {

            return new CreateStructureAction(
                $container->router,
                $container['validator'],
                $container['StructureRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return EnterStructureDataAction
         */
        $container['EnterStructureDataAction'] = function (Container $container): EnterStructureDataAction {

            return new EnterStructureDataAction(
                $container->view
            );
        };
    }
}