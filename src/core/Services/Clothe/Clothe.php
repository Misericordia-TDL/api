<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Clothe;

use App\Models\Clothe as ClotheModel;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Clothe
 * @package Core\Services\Clothe
 */
class Clothe implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return ClotheModel
         */
        $container['ClotheModel'] = function (Container $container): ClotheModel {
            $mongoClient = $container['db'];
            $foodCollection = $mongoClient->misericordia->clothe;
            return new ClotheModel($foodCollection);
        };
    }
}