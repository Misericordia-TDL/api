<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Operator\Repository;

use App\Core\Repository\AbstractRepository;

/**
 * Class OperatorRepository
 * @package App\Operator\Repository
 */
class OperatorRepository extends AbstractRepository
{
    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email)
    {
        return $this->find('email', $email);
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function findByResetToken(string $token)
    {
        return $this->find('password_reset_token', $token);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return parent::insert($data);

    }
}