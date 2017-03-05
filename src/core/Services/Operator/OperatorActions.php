<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Operator;

use App\Controllers\Operator\AuthOperatorAction;
use App\Controllers\Operator\LogOutOperatorAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Controllers\Operator\EditOperatorAction;
use App\Controllers\Operator\CreateOperatorAction;
use App\Controllers\Operator\EnterOperatorDataAction;
use App\Controllers\Operator\UpdateOperatorAction;
use App\Controllers\Operator\DeleteOperatorAction;
use App\Controllers\Operator\IndexAction as OperatorIndexAction;
use App\Controllers\Operator\ListOperatorAction;

/**
 * Class OperatorActions
 * @package Core\Services\Operator\Actions
 */
class OperatorActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return \App\Controllers\Operator\IndexAction
         */
        $container['OperatorIndexAction'] = function (Container $container): OperatorIndexAction {

            return new OperatorIndexAction(
                $container->view
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\ListOperatorAction
         */
        $container['ListOperatorAction'] = function (Container $container): ListOperatorAction {

            return new ListOperatorAction(
                $container->view,
                $container['OperatorModel']
            );
        };
        /**
         * @param Container $container
         * @return \App\Controllers\Operator\EnterOperatorDataAction
         */
        $container['EnterOperatorDataAction'] = function (Container $container): EnterOperatorDataAction {

            return new EnterOperatorDataAction(
                $container->view,
                $container['OperatorLevelModel']
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
                $container['OperatorModel'],
                $container['flash'],
                $container['OperatorLevelModel']
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
                $container['flash'],
                $container['OperatorLevelModel']
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
                $container['OperatorLevelModel'],
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
                $container['OperatorModel'],
                $container['OperatorRepository'],
                $container['flash'],
                $container['OperatorLevelModel']
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