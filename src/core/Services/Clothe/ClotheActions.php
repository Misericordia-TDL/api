<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Clothe;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Controllers\ClotheController;

class ClotheActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return ClotheController
         */
        $container['ClotheController'] = function (Container $container): ClotheController {

            return new ClotheController(
                $container->view,
                $container['ClotheModel']
            );
        };

    }
}