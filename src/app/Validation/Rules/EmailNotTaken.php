<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Models\Eloquent\Operator;
use Respect\Validation\Rules\AbstractRule;

class EmailNotTaken extends AbstractRule
{
    public function validate($input)
    {
        return empty(Operator::where('email', '=', $input)->first());
    }
}