<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\EditAction;

/**
 * Class EditOperatorLevelAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditOperatorLevelAction extends EditAction
{
    /**
     * @var string
     */
    protected $template = 'partials/operator-level/edit-operator-level-data.twig';
    /**
     * @var string
     */
    protected $element = 'operatorLevel';
}