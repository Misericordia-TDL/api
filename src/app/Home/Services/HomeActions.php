<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Services;

use App\Home\Actions\IndexLoggedAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

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
    }
}