<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Clothe\Services;

use App\Clothe\Repository\ClotheRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Clothe
 * @package Core\Services\Clothe\Actions
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
         * @return ClotheRepository
         */
        $container['ClotheRepository'] = function (Container $container): ClotheRepository {

            return new ClotheRepository('\App\Clothe\Model\Clothe');
        };
    }
}