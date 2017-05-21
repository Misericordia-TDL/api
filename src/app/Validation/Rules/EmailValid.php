<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Operator\Repository\OperatorRepository;
use Respect\Validation\Rules\AbstractRule;

class EmailValid extends AbstractRule
{
    protected $operatorRepository;

    function __construct(
        OperatorRepository $operatorRepository
    )
    {
        $this->operatorRepository = $operatorRepository;
    }

    public function validate($input)
    {
        return !empty($this->operatorRepository->findByEmail($input));
    }
}