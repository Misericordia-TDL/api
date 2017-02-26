<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models {

    use MongoDB\InsertOneResult;

    /**
     * Class OperatorLevel
     * @package App\Models
     *
     * @author Javier Mellado <sol@javiermellado.com>
     */
    class OperatorLevel extends AbstractModel
    {
        /**
         * @param $data
         * @return InsertOneResult
         */
        public function insert($data) : InsertOneResult
        {
            return $this->persist($data, ['join_date']);
        }

        /**
         * @param $level
         */
        public function findByLevel($level)
        {
            return $this->collection->findOne(['level' => (int) $level]);
        }
    }
}