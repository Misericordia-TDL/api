<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent clothe data into a form to be edited
 */

namespace App\Clothe\Actions;

use App\Core\Actions\EditAction;

/**
 * Class EditClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EditClotheAction extends EditAction
{
    /**
     * @var string
     */
    protected $template = 'partials/clothe/edit-clothe-data.twig';
    /**
     * @var string
     */
    protected $element = 'clothe';
}