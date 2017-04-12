<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Medicine\Model;

use App\Core\Model\AbstractModel;

/**
 * Class Medicine
 * @package App\Models
 */
class Medicine extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'medicine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'arrival_date',
	'expiry_date',
	'quantity'
    ];

}