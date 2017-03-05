<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\OperatorLevel;

use App\Controllers\OperatorLevel\CreateOperatorLevelAction;
use App\Controllers\OperatorLevel\DeleteOperatorLevelAction;
use App\Controllers\OperatorLevel\EditOperatorLevelAction;
use App\Controllers\OperatorLevel\EnterOperatorLevelDataAction;
use App\Controllers\OperatorLevel\ListOperatorLevelAction;
use App\Controllers\OperatorLevel\UpdateOperatorLevelAction;
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
         * @return EnterOperatorLevelDataAction
         */
        $container['EnterOperatorLevelDataAction'] = function (Container $container): EnterOperatorLevelDataAction {

        };
        /**
         * @param Container $container
         * @return CreateOperatorLevelAction
         */
        $container['CreateOperatorLevelAction'] = function (Container $container): CreateOperatorLevelAction {

        };
        /**
         * @param Container $container
         * @return UpdateOperatorLevelAction
         */
        $container['UpdateOperatorLevelAction'] = function (Container $container): UpdateOperatorLevelAction {

        };
        /**
         * @param Container $container
         * @return EditOperatorLevelAction
         */
        $container['EditOperatorLevelAction'] = function (Container $container): EditOperatorLevelAction {


        };
        /**
         * @param Container $container
         * @return DeleteOperatorLevelAction
         */
        $container['DeleteOperatorLevelAction'] = function (Container $container): DeleteOperatorLevelAction {

        };
    }
}