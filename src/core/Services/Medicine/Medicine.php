<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Medicine;

use App\Models\Medicine as MedicineModel;
use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class Medicine
 * @package Core\Services\Medicine
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
         * @return MedicineModel
         */
        $container['MedicineModel'] = function (Container $container): MedicineModel {

            $mongoClient = $container['db'];
            $medicineCollection = $mongoClient->misericordia->medicine;
            $medicineModel = new MedicineModel($medicineCollection);

            return $medicineModel;
        };
    }
}