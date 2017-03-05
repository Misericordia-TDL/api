<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class AbstractModel
 * @package App\Models
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class AbstractModel extends Eloquent
{
    /**
     * string collection name
     */
    protected $collection;

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}