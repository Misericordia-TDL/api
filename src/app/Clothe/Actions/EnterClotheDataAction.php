<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will create a valid new clothe form to be added to the clothe collection
 */

namespace App\Clothe\Actions;

use App\Core\Actions\EnterDataAction;

/**
 * Class EnterClotheDataAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterClotheDataAction extends EnterDataAction
{
    protected $template = 'partials/clothe/enter-clothe-data.twig';
}
