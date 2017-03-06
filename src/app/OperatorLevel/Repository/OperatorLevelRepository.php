<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Repository;

use App\Core\Repository\AbstractRepository;

/**
 * Class OperatorLevelRepository
 * @package App\Models\Eloquent
 */
class OperatorLevelRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $modelClass = '\App\OperatorLevel\Model\OperatorLevel';

    /**
     * @param $level
     * @return mixed
     */
    public function findByLevel($level)
    {
        return $this->find('level', $level);
    }
}