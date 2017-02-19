<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models {

    use MongoDB\InsertOneResult;

    /**
     * Class Medicine
     * @package App\Models
     *
     * @author Javier Mellado <sol@javiermellado.com>
     */
    class Medicine extends AbstractModel
    {
        /**
         * @param $data
         * @return InsertOneResult
         */
        public function insert($data) : InsertOneResult
        {
            return $this->persist($data, ['arrival_date', 'expiry_date']);
        }
    }
}