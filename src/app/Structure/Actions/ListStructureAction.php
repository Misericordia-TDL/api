<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;

use App\Core\Actions\ListAction;

class ListStructureAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'structures';
    /**
     * @var  string
     */
    protected $template = 'partials/structure/list.twig';
}