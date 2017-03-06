<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\OperatorLevel\Services;

use App\OperatorLevel\Actions\CreateOperatorLevelAction;
use App\OperatorLevel\Actions\DeleteOperatorLevelAction;
use App\OperatorLevel\Actions\EditOperatorLevelAction;
use App\OperatorLevel\Actions\EnterOperatorLevelDataAction;
use App\OperatorLevel\Actions\ListOperatorLevelAction;
use App\OperatorLevel\Actions\UpdateOperatorLevelAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class OperatorLevelActions
 * @package OperatorLevel\Services
 */
class OperatorLevelActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return ListOperatorLevelAction
         */
        $container['ListOperatorLevelAction'] = function (Container $container): ListOperatorLevelAction {

            return new ListOperatorLevelAction(
                $container->view,
                $container['OperatorLevelRepository']
            );
        };
        /**
         * @param Container $container
         * @return EnterOperatorLevelDataAction
         */
        $container['EnterOperatorLevelDataAction'] = function (Container $container): EnterOperatorLevelDataAction {
            return new EnterOperatorLevelDataAction(
                $container->view
            );
        };
        /**
         * @param Container $container
         * @return CreateOperatorLevelAction
         */
        $container['CreateOperatorLevelAction'] = function (Container $container): CreateOperatorLevelAction {
            return new CreateOperatorLevelAction(
                $container->router,
                $container['validator'],
                $container['OperatorLevelRepository'],
                $container['flash']
            );
        };
        /**
         * @param Container $container
         * @return UpdateOperatorLevelAction
         */
        $container['UpdateOperatorLevelAction'] = function (Container $container): UpdateOperatorLevelAction {
            return new UpdateOperatorLevelAction(
                $container->router,
                $container['validator'],
                $container['OperatorLevelRepository'],
                $container['flash']
            );
        };
        /**
         * @param Container $container
         * @return EditOperatorLevelAction
         */
        $container['EditOperatorLevelAction'] = function (Container $container): EditOperatorLevelAction {
            return new EditOperatorLevelAction(
                $container->view,
                $container['OperatorLevelRepository'],
                $container->router
            );
        };

        /**
         * @param Container $container
         * @return DeleteOperatorLevelAction
         */
        $container['DeleteOperatorLevelAction'] = function (Container $container): DeleteOperatorLevelAction {
            return new DeleteOperatorLevelAction(
                $container->router,
                $container['auth'],
                $container['OperatorLevelRepository'],
                $container['flash']
            );
        };
    }
}