<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Clothe\Repository;

use App\Core\Repository\AbstractRepository;

/**
 * Class ClotheRepository
 * @package App\Clothe\Repository
 */
class ClotheRepository extends AbstractRepository
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