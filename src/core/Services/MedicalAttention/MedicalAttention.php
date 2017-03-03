<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace Core\Services\MedicalAttention;

use App\Models\MedicalAttention as MedicalAttentionModel;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MedicalAttention implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        /**
         * @param Container $container
         * @return MedicalAttentionModel
         */
        $container['MedicalAttentionModel'] = function (Container $container): MedicalAttentionModel {
            $mongoClient = $container['db'];
            $medicalAttentionCollection = $mongoClient->misericordia->medical_attention;
            return new MedicalAttentionModel($medicalAttentionCollection);
        };
    }
}