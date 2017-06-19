<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent food data into a form to be edited
 */

namespace App\Food\Actions;

use App\Core\Actions\EditAction;

/**
 * Class EditFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EditFoodAction extends EditAction
{
    /**
     * @var string
     */
    protected $template = 'partials/food/edit-food-data.twig';
    /**
     * @var string
     */
    protected $element = 'food';
}