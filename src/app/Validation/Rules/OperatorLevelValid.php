<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Models\OperatorLevelEloquent as OperatorLevel;
use Respect\Validation\Rules\AbstractRule;

class OperatorLevelValid extends AbstractRule
{
    public function validate($input)
    {
        return !empty(OperatorLevel::where('level', '=', (int) $input)->first());
    }
}