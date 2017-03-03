<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Refugee;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Models\Refugee as RefugeeModel;

class Refugee implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return RefugeeModel
         */
        $container['RefugeeModel'] = function (Container $container): RefugeeModel {

            $mongoClient = $container['db'];
            $refugeeCollection = $mongoClient->misericordia->refugee;
            return new RefugeeModel($refugeeCollection);
        };
    }
}