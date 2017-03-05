<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\OperatorLevel;

use App\Controllers\OperatorLevel\ListOperatorLevelAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class OperatorLevelActions
 * @package Core\Services\OperatorLevel
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
         * @return \App\Controllers\Operator\EnterOperatorDataAction
         */
        $container['EnterOperatorDataAction'] = function (Container $container): EnterOperatorDataAction {

            return new EnterOperatorDataAction(
                $container->view,
                $container['OperatorLevelRepository']
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\CreateOperatorAction
         */
        $container['CreateOperatorAction'] = function (Container $container): CreateOperatorAction {

            return new CreateOperatorAction(
                $container->router,
                $container['validator'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\UpdateOperatorAction
         */
        $container['UpdateOperatorAction'] = function (Container $container): UpdateOperatorAction {

            return new UpdateOperatorAction(
                $container->router,
                $container['validator'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\EditOperatorAction
         */
        $container['EditOperatorAction'] = function (Container $container): EditOperatorAction {

            return new EditOperatorAction(
                $container->view,
                $container['OperatorRepository'],
                $container['OperatorLevelRepository'],
                $container->router
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\DeleteOperatorAction
         */
        $container['DeleteOperatorAction'] = function (Container $container): DeleteOperatorAction {

            return new DeleteOperatorAction(
                $container->router,
                $container['auth'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return LogOutOperatorAction
         */
        $container['LogOutOperatorAction'] = function (Container $container): LogOutOperatorAction {

            return new LogOutOperatorAction(
                $container->router,
                $container['auth']
            );
        };


        /**
         * @param Container $container
         * @return \App\Controllers\Operator\AuthOperatorAction
         */
        $container['AuthOperatorAction'] = function (Container $container): AuthOperatorAction {

            return new AuthOperatorAction(
                $container->router,
                $container['auth'],
                $container['validator'],
                $container['flash']
            );
        };
    }
}