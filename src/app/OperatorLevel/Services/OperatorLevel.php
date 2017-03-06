<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\OperatorLevel\Services;

use App\OperatorLevel\Repository\OperatorLevelRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class OperatorLevel
 * @package OperatorLevel\Services
 */
class OperatorLevel implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return OperatorLevelRepository
         */
        $container['OperatorLevelRepository'] = function (Container $container): OperatorLevelRepository {

            return new OperatorLevelRepository();
        };
    }
}