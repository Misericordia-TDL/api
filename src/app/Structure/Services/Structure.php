<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Structure\Services;

use App\Structure\Repository\StructureRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Structure
 * @package Core\Services\Food\Actions
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
         * @return StructureRepository
         */
        $container['StructureRepository'] = function (Container $container): StructureRepository {

            return new StructureRepository('\App\Structure\Model\Structure');
        };
    }
}