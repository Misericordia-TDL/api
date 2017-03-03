<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\MedicalAttention;

use App\Controllers\MedicalAttentionController; use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MedicalAttentionActions implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param  Container $container
         * @return MedicalAttentionController
         */
        $container['MedicalAttentionController'] = function (Container $container): MedicalAttentionController {

            return new MedicalAttentionController(
                $container->view,
                $container['MedicalAttentionModel']
            );
        };
    }
}