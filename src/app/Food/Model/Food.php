<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Food\Model;

use App\Core\Model\AbstractModel;

/**
 * Class Food
 * @package App\Models
 */
class Food extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'food';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'quantity'
    ];

}