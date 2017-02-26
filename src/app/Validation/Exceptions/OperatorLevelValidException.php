<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class OperatorLevelValidException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Admin level is not valid'
        ],
    ];

}