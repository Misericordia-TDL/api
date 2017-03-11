<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will check if there's a valid session for the current user. In the case
 * there's a valid session, an Operator model will be return.
 * @author Javier Mellado <sol@javiermellado.com>
 */


namespace App\Auth;

use App\Operator\Model\Operator;
use App\Operator\Repository\OperatorRepository;

/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{

    /** @var OperatorRepository */
    private $operatorRepository;
    /**
     * @var null
     */
    private $user = null;

    /**
     * Auth constructor.
     * @param OperatorRepository $operatorRepository
     */
    function __construct(
        OperatorRepository $operatorRepository
    )
    {
        $this->operatorRepository = $operatorRepository;
    }

    /**
     * Check if there's a valid session for current operator.
     * @return bool
     */
    public function check()
    {
        return isset($_SESSION['operator']);
    }

    /**
     * destroy a valid session
     * @return void
     */
    public function destroySession()
    {
        unset($_SESSION['operator']);
    }

    /**
     * Return current logged in operator
     * @return Operator|null
     */
    public function user()
    {
        if (isset($_SESSION['operator'])) {
            if ($this->user === null) {
                $this->user = $this->operatorRepository->findById($_SESSION['operator']);
            }
            return $this->user;
        }
        return null;
    }

    /**
     * Return current logged in operator id
     * @return string | null
     */
    public function currentUserId()
    {
        if (isset($_SESSION['operator'])) {
            return $_SESSION['operator'];
        }
        return null;
    }

    /**
     * Attempt to login with provided email and passord
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attempt(string $email, string $password)
    {
        //grab the user by email
        //if !user return false
        try {
            $operator = $this->operatorRepository->findByEmail($email);
            //verify password for that user
            if (password_verify($password, $operator->password)) {
                //set into session
                $_SESSION['operator'] = $operator->id;
                return true;
            }
        } catch (\InvalidArgumentException $e) {
        }
        return false;
    }
}