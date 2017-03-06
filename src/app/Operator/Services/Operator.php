<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services\Operator;

use App\Operator\Repository\OperatorRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class Operator
 * @package Core\Services\Operator\Actions
 */
class Operator implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return OperatorRepository
         */
        $container['OperatorRepository'] = function (Container $container): OperatorRepository {

            return new OperatorRepository();
        };
    }
}