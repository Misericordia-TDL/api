<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Food\Repository;

use App\Core\Repository\AbstractRepository;

/**
 * Class FoodRepository
 * @package App\Food\Repository
 */
class FoodRepository extends AbstractRepository
{

    /**
     * @param string $name
     * @return mixed
     */
    public function findByName(string $name)
    {
        return $this->find('name', $name);
    }


}