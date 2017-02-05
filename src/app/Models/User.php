<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models;

use MongoDB\Collection;

/**
 * Class User
 * @package App\Models
 *
 * @author Javier Mellado <sol@javiermellado.com>
 */
class User
{

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * User constructor.
     * @param Collection $collection
     */
    function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $result = $this->collection->find();
        $arrayData = [];
        foreach ($result as $entry) {
            $arrayData[] = $entry['name'];
        }

        return $arrayData;
    }
}