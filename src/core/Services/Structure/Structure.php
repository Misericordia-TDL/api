<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\Structure;

use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class Logout
 * @package Core\Services\Operator\Actions
 */
class Structure implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return Structure
         */
        $container['StructureModel'] = function (Container $container): Structure {
            $mongoClient = $container['db'];
            $operatorLevelCollection = $mongoClient->misericordia->structure;
            $structureModel = new Structure($operatorLevelCollection);

            return $structureModel;
        };
    }
}