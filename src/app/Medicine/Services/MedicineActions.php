<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Medicine\Services;

use App\Medicine\Actions\CreateMedicineAction;
use App\Medicine\Actions\EnterMedicineDataAction;
use App\Medicine\Actions\DeleteMedicineAction;
use App\Medicine\Actions\EditMedicineAction;
use App\Medicine\Actions\UpdateMedicineAction;
use App\Medicine\Actions\ListMedicineAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class MedicineActions
 * @package Core\Services\Medicine\Actions
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
         * @return EditMedicineAction
         */
        $container['EditMedicineAction'] = function (Container $container): EditMedicineAction {

            return new EditMedicineAction(
                $container->view,
                $container['MedicineRepository'],
                $container->router
            );
        };

	/**
         * @param Container $container
         * @return UpdateMedicineAction
         */
        $container['UpdateMedicineAction'] = function (Container $container): UpdateMedicineAction {

            return new UpdateMedicineAction(
                $container->router,
                $container['validator'],
                $container['MedicineRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return DeleteMedicineAction
         */
        $container['DeleteMedicineAction'] = function (Container $container): DeleteMedicineAction {

            return new DeleteMedicineAction(
                $container->router,
                $container['MedicineRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return ListMedicineAction
         */
        $container['ListMedicineAction'] = function (Container $container): ListMedicineAction {

            return new ListMedicineAction(
                $container->view,
		$container['MedicineRepository']
		);
        };

        /**
         * @param Container $container
         * @return CreateMedicineAction
         */
        $container['CreateMedicineAction'] = function (Container $container): CreateMedicineAction {

            return new CreateMedicineAction(
                $container->router,
                $container['validator'],
                $container['MedicineRepository'],
                $container['flash']
            );
        };

        /**
         * @param Container $container
         * @return EnterMedicineDataAction
         */
        $container['EnterMedicineDataAction'] = function (Container $container): EnterMedicineDataAction {

            return new EnterMedicineDataAction(
                $container->view
            );
        };
    }
}