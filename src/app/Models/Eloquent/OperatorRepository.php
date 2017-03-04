<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models\Eloquent;

class OperatorRepository
{

    public function all()
    {
        return Operator::all();
    }

    public function findById($id)
    {

        return $this->find('id', $id);

    }

    public function find($field, $value)
    {

        return Operator::where($field, '=', $value)->first();
    }

    public function findByEmail(string $email)
    {
        return $this->find('email', $email);
    }
}