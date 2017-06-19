<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all clothes in the platform
 */

namespace App\Clothe\Actions;

use App\Core\Actions\ListAction;

/**
 * Class ListClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListClotheAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'clothes';
    /**
     * @var  string
     */
    protected $template = 'partials/clothe/list.twig';
}