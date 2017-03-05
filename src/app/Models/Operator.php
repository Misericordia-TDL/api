<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models;

/**
 * Class Operator
 * @package App\Models
 */
class Operator extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'operator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'operator_level',
        'phonenumber',
    ];
}