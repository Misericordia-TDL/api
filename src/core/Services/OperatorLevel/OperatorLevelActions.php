<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\OperatorLevel;

use App\Controllers\OperatorLevelController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class OperatorLevelActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return \App\Controllers\OperatorLevelController
         */
        $container['OperatorLevelController'] = function (Container $container): OperatorLevelController {

            return new OperatorLevelController(
                $container->view,
                $container['OperatorLevelModel']
            );
        };
    }
}