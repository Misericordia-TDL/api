<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\ListAction;

/**
 * Class ListOperatorLevelAction
 * @package App\Controllers\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListOperatorLevelAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'operatorsLevel';
    /**
     * @var  string
     */
    protected $template = 'partials/operator-level/list.twig';
}