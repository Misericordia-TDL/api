<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Operator\Services;

use App\Operator\Actions\AuthOperatorAction;
use App\Operator\Actions\CreateOperatorAction;
use App\Operator\Actions\DeleteOperatorAction;
use App\Operator\Actions\EditOperatorAction;
use App\Operator\Actions\EnterOperatorDataAction;
use App\Operator\Actions\IndexAction as OperatorIndexAction;
use App\Operator\Actions\ListOperatorAction;
use App\Operator\Actions\LogOutOperatorAction;
use App\Operator\Actions\UpdateOperatorAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

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
         * @return OperatorIndexAction
         */
        $container['OperatorIndexAction'] = function (Container $container): OperatorIndexAction {

            return new OperatorIndexAction(
                $container->view
            );
        };
        /**
         * @param Container $container
         * @return ListOperatorAction
         */
        $container['ListOperatorAction'] = function (Container $container): ListOperatorAction {

            return new ListOperatorAction(
                $container->view,
                $container['OperatorRepository']
            );
        };
        /**
         * @param Container $container
         * @return EnterOperatorDataAction
         */
        $container['EnterOperatorDataAction'] = function (Container $container): EnterOperatorDataAction {

            return new EnterOperatorDataAction(
                $container->view,
                $container['OperatorLevelRepository']
            );
        };
        /**
         * @param Container $container
         * @return CreateOperatorAction
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
         * @return UpdateOperatorAction
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
         * @return EditOperatorAction
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
         * @return DeleteOperatorAction
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
         * @return AuthOperatorAction
         */
        $container['AuthOperatorAction'] = function (Container $container): AuthOperatorAction {

            return new AuthOperatorAction(
                $container->router,
                $container['auth'],
                $container['validator'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };
    }
}