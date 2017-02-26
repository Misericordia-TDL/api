<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Models\Operator;
use Respect\Validation\Rules\AbstractRule;

class EmailEditable extends AbstractRule
{
    protected $operatorModel;
    /**
     * @var string
     */
    private $originalEmail;

    /**
     * EmailEditable constructor.
     * @param Operator $operatorModel
     * @param string $originalEmail
     */
    function __construct(
        Operator $operatorModel,
        string $originalEmail
    )
    {
        $this->operatorModel = $operatorModel;
        $this->originalEmail = $originalEmail;
    }

    public function validate($input)
    {
        $foundEmail =  $this->operatorModel->findByEmail($input);

        $return =  false;

        if (empty($foundEmail) || $foundEmail->email == $this->originalEmail ) {
            $return = true;
        }
        return $return;
    }
}