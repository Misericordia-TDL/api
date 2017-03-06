<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation\Rules;

use App\Auth\Auth;
use App\Operator\Model\Operator;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class PasswordValid
 * @package App\Validation\Rules
 */
class PasswordValid extends AbstractRule
{

    /**
     * string
     */
    protected $email;
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * PasswordValid constructor.
     * @param string $email
     * @param Auth $auth
     */
    function __construct(
        string $email,
        Auth $auth
    )
    {
        $this->email = $email;
        $this->auth = $auth;
    }

    /**
     * @param $input
     * @return bool
     */
    public function validate($input)
    {

        return $this->auth->attempt($this->email, $input);
    }
}