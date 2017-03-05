<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\OperatorLevel;

use App\Repository\OperatorLevelRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class OperatorLevel
 * @package Core\Services\Operator\Actions
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