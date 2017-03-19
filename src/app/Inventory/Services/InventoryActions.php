<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Inventory\Services;

use App\Inventory\Actions\IndexAction as InventoryIndexAction;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class InventoryActions
 * @package Core\Services\Inventory\Actions
 */
class InventoryActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return InventoryIndexAction
         */
        $container['InventoryIndexAction'] = function (Container $container): InventoryIndexAction {

            return new InventoryIndexAction(
                $container->view
            );
        };
    }
}