<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Model;

use App\Core\Model\AbstractModel;

/**
 * Class Structure
 * @package App\Models
 */
class Structure extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'structure';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'capacity',
        'current_occupants',
    ];

}