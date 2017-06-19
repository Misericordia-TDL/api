<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\EnterDataAction;

/**
 * Class EnterOperatorLevelDataAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterOperatorLevelDataAction extends EnterDataAction
{
    protected $template = 'partials/operator-level/enter-operator-level-data.twig';
}
