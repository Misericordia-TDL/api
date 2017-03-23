<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Services;

use App\Home\Actions\EnterNewPasswordAction;
use App\Home\Actions\EnterResetPasswordEmailAction;
use App\Home\Actions\IndexLoggedAction;
use App\Home\Actions\ResetPasswordAction;
use App\Home\Actions\SaveNewPasswordAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class HomeActions
 * @package App\Home\Services
 */
class HomeActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param  Container $container
         * @return IndexLoggedAction
         */
        $container['HomeLoggedinIndexAction'] = function (Container $container): IndexLoggedAction {
            return new IndexLoggedAction(
                $container->view,
                $container['auth']
            );
        };

        /**
         * @param Container $container
         * @return EnterResetPasswordEmailAction
         */
        $container['EnterResetPasswordEmailAction'] = function (Container $container): EnterResetPasswordEmailAction {

            return new EnterResetPasswordEmailAction(
                $container->view
            );
        };

        /**
         * @param Container $container
         * @return EnterNewPasswordAction
         */
        $container['EnterNewPasswordAction'] = function (Container $container): EnterNewPasswordAction {

            return new EnterNewPasswordAction(
                $container->view,
                $container['OperatorRepository'],
                $container['flash'],
                $container->router
            );
        };


        /**
         * @param Container $container
         * @return ResetPasswordAction
         */
        $container['ResetPasswordAction'] = function (Container $container): ResetPasswordAction {

            return new ResetPasswordAction(
                $container->router,
                $container['validator'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };
        /**
         * @param Container $container
         * @return SaveNewPasswordAction
         */
        $container['SaveNewPasswordAction'] = function (Container $container): SaveNewPasswordAction {

            return new SaveNewPasswordAction(
                $container->router,
                $container['validator'],
                $container['OperatorRepository'],
                $container['flash']
            );
        };
    }
}