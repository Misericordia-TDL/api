<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all operators in the platform
 */

namespace App\Operator\Actions;

use App\Core\Actions\ListAction;

/**
 * Class ListOperatorAction
 * @package App\Operator\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListOperatorAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'operators';
    /**
     * @var  string
     */
    protected $template = 'partials/operator/list.twig';
}
