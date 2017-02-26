<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Auth;

use App\Models\Operator;
use MongoDB\BSON\ObjectID;


/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{

    /** @var Operator */
    private $operator;

    /**
     * Auth constructor.
     * @param Operator $operator
     */
    function __construct(
        Operator $operator
    )
    {
        $this->operator = $operator;
    }

    public function check() {
        return isset($_SESSION['operator']);
    }
    public function user() {
        if(isset($_SESSION['operator'])) {
            return $this->operator->findById($_SESSION['operator']);
        }
        return null;
    }
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attempt(string $email, string $password)
    {
        //grab the user by email
        //if !user return false
        if (!$operator = $this->operator->findByEmail($email)) {
            return false;
        }
        //verify password for that user
        if (password_verify($password, $operator->password)) {
            //set into session
            $_SESSION['operator'] = $operator->_id->__toString();
            return true;
        }
        return false;
    }
}