<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Home\Services;

use App\Home\Actions\IndexAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Home
 * @package Core\Services\Home
 */
class Home implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return IndexAction
         */
        $container['HomeIndexAction'] = function (Container $container): IndexAction {
            return new IndexAction(
                $container->view
            );
        };
    }
}