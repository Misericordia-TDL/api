<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Auth;

use App\Repository\OperatorRepository;


/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{

    /** @var OperatorRepository */
    private $operatorRepository;
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

    public function check()
    {
        return isset($_SESSION['operator']);
    }

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

    public function currentUserId()
    {
        if (isset($_SESSION['operator'])) {
            return $_SESSION['operator'];
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
        try{
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