<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * All models in this application will be eloquent models with a set of features in common:
 *
 * - same date fields
 * - soft deletion
 * - collection name as a property
 *
 * @see https://github.com/jenssegers/laravel-mongodb#eloquent
 */

namespace App\Core\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class AbstractModel
 * @package App\Core
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