<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all foods in the platform
 */

namespace App\Food\Actions;

use App\Core\Actions\ListAction;

/**
 * Class ListFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListFoodAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'foods';
    /**
     * @var  string
     */
    protected $template = 'partials/food/list.twig';
}