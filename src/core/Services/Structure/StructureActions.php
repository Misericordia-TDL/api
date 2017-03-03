<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Structure;


use App\Controllers\StructureController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class StructureActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {


        /**
         * @param Container $container
         * @return StructureController
         */
        $container['StructureController'] = function (Container $container): StructureController {

            return new StructureController(
                $container->view,
                $container['StructureModel']
            );
        };


    }
}