<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Model;

use App\Core\Model\AbstractModel;

/**
 * Class OperatorLevel
 * @package App\Models
 */
class OperatorLevel extends AbstractModel
{
    /**
     * @var string
     */
    protected $collection = 'operator_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'level',
    ];

    public function operators()
    {
        return $this->embedsOne('App\Models\Operator', '_id', 'operator_level');
    }

}