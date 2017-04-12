<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Clothe\Model;

use App\Core\Model\AbstractModel;

/**
 * Class Clothe
 * @package App\Models
 */
class Clothe extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'clothe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'arrival_date',
	'size',
	'quantity'
    ];

}