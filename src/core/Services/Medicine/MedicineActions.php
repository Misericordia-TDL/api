<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\Medicine;

use Pimple\Container;
use App\Controllers\MedicineController;
use Pimple\ServiceProviderInterface;

/**
 * Class MedicineActions
 * @package Core\Services\Medicine
 */
class MedicineActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return MedicineController
         */
        $container['MedicineController'] = function (Container $container): MedicineController {

            return new MedicineController(
                $container->view,
                $container['MedicineModel']
            );
        };
    }
}