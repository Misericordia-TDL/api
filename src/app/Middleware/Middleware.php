<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 * Base middleware where the container gets injected
 */

namespace App\Middleware;

use Interop\Container\ContainerInterface as Container;

/**
 * Class Middleware
 * @package App\Middleware
 * @author Javier Mellado <sol@javiermellado.com>
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