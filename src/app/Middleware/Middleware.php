<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Middleware;

use Interop\Container\ContainerInterface as Container;

/**
 * Class Middleware
 * @package App\Middleware
 */
class Middleware
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * Middleware constructor.
     * @param Container $container
     */
    function __construct(Container $container)
    {
        $this->container = $container;
    }
}