<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Medicine\Services;

use App\Medicine\Repository\MedicineRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Medicine
 * @package Core\Services\Medicine\Actions
 */
class Medicine implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        /**
         * @param Container $container
         * @return MedicineRepository
         */
        $container['MedicineRepository'] = function (Container $container): MedicineRepository {

            return new MedicineRepository('\App\Medicine\Model\Medicine');
        };
    }
}