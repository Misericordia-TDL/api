<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Food\Services;

use App\Food\Repository\FoodRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Food
 * @package Core\Services\Food\Actions
 */
class Food implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return FoodRepository
         */
        $container['FoodRepository'] = function (Container $container): FoodRepository {

            return new FoodRepository('\App\Food\Model\Food');
        };
    }
}