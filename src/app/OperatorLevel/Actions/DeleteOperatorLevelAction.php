<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\DeleteAction;

/**
 * Class DeleteOperatorLevelAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteOperatorLevelAction extends DeleteAction
{
    /**
     * @var string
     */
    protected $element = 'operator-level';
}