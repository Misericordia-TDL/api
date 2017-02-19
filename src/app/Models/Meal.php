<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models {
    use MongoDB\InsertOneResult;

    /**
     * Class Meal
     * @package App\Models
     *
     * @author Javier Mellado <sol@javiermellado.com>
     */
    class Meal extends AbstractModel
    {

        /**
         * @param $data
         * @return InsertOneResult
         */
        public function insert($data) : InsertOneResult
        {
            return $this->persist($data, ['serve_date']);
        }
    }
}