<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;

use App\Core\Actions\EnterDataAction;

/**
 * Class EnterFoodDataAction
 * @package App\Food\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterStructureDataAction extends EnterDataAction
{
    protected $template = 'partials/structure/enter-structure-data.twig';
}
