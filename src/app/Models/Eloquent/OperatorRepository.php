<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models\Eloquent;

/**
 * Class OperatorRepository
 * @package App\Models\Eloquent
 */
class OperatorRepository
{

    public function getAll()
    {
        return Operator::all();
    }

    public function findByEmail(string $email)
    {
        return $this->find('email', $email);
    }

    public function find($field, $value)
    {
        $operator = Operator::where($field, '=', $value)->first();

        if (!$operator) throw new \InvalidArgumentException;

        return $operator;
    }

    /**
     * @param array $data
     * @return
     */
    public function update($data)
    {

        return $this->findById($data['id'])->update($data);
    }

    public function findById($id)
    {
        return $this->find('_id', $id);
    }

    /**
     * @param string $id
     * @return
     */
    public function delete($id)
    {
        $operator = $this->findById($id);

        return $operator->delete();

    }
    /**
     * @param array $data
     * @return
     */
    public function insert($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return Operator::create($data);

    }
}