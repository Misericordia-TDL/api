<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;

use App\Core\Actions\EditAction;

/**
 * Class EditFoodAction
 * @package App\Food\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditStructureAction extends EditAction
{
    /**
     * @var string
     */
    protected $template = 'partials/structure/edit-structure-data.twig';
    /**
     * @var string
     */
    protected $element = 'structure';
}