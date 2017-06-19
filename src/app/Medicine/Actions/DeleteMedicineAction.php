<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will mark as delete an operator
 */

namespace App\Medicine\Actions;

use App\Core\Actions\DeleteAction;

/**
 * Class DeleteMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteMedicineAction extends DeleteAction
{
    /**
     * @var string
     */
    protected $element = 'medicine';
}