<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;

use App\Core\Actions\DeleteAction;

/**
 * Class DeleteFoodAction
 * @package App\Food\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteStructureAction extends DeleteAction
{
    /**
     * @var string
     */
    protected $element = 'structure';
}