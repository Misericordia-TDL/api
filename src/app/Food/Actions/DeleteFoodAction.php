<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will mark as delete an operator
 */

namespace App\Food\Actions;

use App\Core\Actions\DeleteAction;

/**
 * Class DeleteFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteFoodAction extends DeleteAction
{
    /**
     * @var string
     */
    protected $element = 'food';
}