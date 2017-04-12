<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Medicine\Repository;

use App\Core\Repository\AbstractRepository;

/**
 * Class MedicineRepository
 * @package App\Medicine\Repository
 */
class MedicineRepository extends AbstractRepository
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