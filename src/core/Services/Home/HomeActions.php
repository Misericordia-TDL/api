<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Home;

use App\Controllers\Home\IndexLoggedAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class HomeActions
 * @package Core\Services\Home
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
        $container['HomeLoggedinIndexAction'] = function (Container  $container): IndexLoggedAction {

            return new IndexLoggedAction(
                $container->view,
                $container['auth']
            );
        };

    }
}