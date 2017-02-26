<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Models\Operator;
use Respect\Validation\Rules\AbstractRule;

class EmailValid extends AbstractRule
{
    protected $operatorModel;

    function __construct(
        Operator $operatorModel
    )
    {
        $this->operatorModel = $operatorModel;
    }

    public function validate($input)
    {
        return !empty($this->operatorModel->findByEmail($input));
    }
}