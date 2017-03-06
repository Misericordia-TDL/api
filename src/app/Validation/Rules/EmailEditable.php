<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Operator\Model\Operator;
use Respect\Validation\Rules\AbstractRule;

class EmailEditable extends AbstractRule
{
    /**
     * @var string
     */
    private $originalEmail;

    /**
     * EmailEditable constructor.
     * @param string $originalEmail
     */
    function __construct(
        string $originalEmail
    )
    {
        $this->originalEmail = $originalEmail;
    }

    public function validate($input)
    {
        $foundOperator =  Operator::where('email', '=', $input)->first();

        $return =  false;

        if (empty($foundOperator) || $foundOperator->email == $this->originalEmail ) {
            $return = true;
        }
        return $return;
    }
}