<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will create a valid new medicine form to be added to the medicine collection
 */

namespace App\Medicine\Actions;

use App\Core\Actions\EnterDataAction;

/**
 * Class EnterMedicineDataAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EnterMedicineDataAction extends EnterDataAction
{
    protected $template = 'partials/medicine/enter-medicine-data.twig';
}