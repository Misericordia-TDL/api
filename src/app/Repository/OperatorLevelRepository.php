<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Repository;

/**
 * Class OperatorLevelRepository
 * @package App\Models\Eloquent
 */
class OperatorLevelRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $modelClass = '\App\Models\OperatorLevel';

    /**
     * @param $level
     * @return mixed
     */
    public function findByLevel($level)
    {
        return $this->find('level', $level);
    }
}