<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Repository;

/**
 * Class OperatorRepository
 * @package App\Models\Eloquent
 */
class OperatorRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $modelClass = '\App\Models\Operator';

    public function findByEmail(string $email)
    {
        return $this->find('email', $email);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return parent::insert($data);

    }
}