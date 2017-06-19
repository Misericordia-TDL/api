<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent medicine data into a form to be edited
 */

namespace App\Medicine\Actions;

use App\Core\Actions\EditAction;

/**
 * Class EditMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditMedicineAction extends EditAction
{
    /**
     * @var string
     */
    protected $template = 'partials/medicine/edit-medicine-data.twig';
    /**
     * @var string
     */
    protected $element = 'medicine';
}