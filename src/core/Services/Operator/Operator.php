<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\Operator;

use App\Models\Operator as OperatorModel;
use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class Logout
 * @package Core\Services\Operator\Actions
 */
class Operator implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return OperatorModel
         */
        $container['OperatorModel'] = function (Container $container): OperatorModel {

            $mongoClient = $container['db'];
            $operatorCollection = $mongoClient->misericordia->operator;
            $userModel = new OperatorModel($operatorCollection);

            return $userModel;
        };
    }
}