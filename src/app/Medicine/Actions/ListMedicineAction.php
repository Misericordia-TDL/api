<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all medicines in the platform
 */

namespace App\Medicine\Actions;

use App\Core\Actions\ListAction;

/**
 * Class ListMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class ListMedicineAction extends ListAction
{
    /**
     * @var string
     */
    protected $listElements = 'medicines';
    /**
     * @var  string
     */
    protected $template = 'partials/medicine/list.twig';
}