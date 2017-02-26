<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class EmailNotTakenException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken by another user'
        ],
    ];

}