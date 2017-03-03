<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Refugee;


use App\Controllers\RefugeeController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RefugeeActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return RefugeeController
         */
        $container['RefugeeController'] = function (Container $container): RefugeeController {

            return new RefugeeController(
                $container->view,
                $container['RefugeeModel']
            );
        };


    }
}