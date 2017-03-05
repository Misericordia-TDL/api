<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Repository;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
class AbstractRepository
{
    /**
     * @var string
     */
    protected $modelClass = null;

    /**
     * @return mixed
     */
    public function getAll()
    {
        $modelClass = $this->modelClass;
        return $modelClass::all();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function delete($id)
    {

        $model = $this->findById($id);

        return $model->delete();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->find('_id', $id);
    }

    /**
     * @param $field
     * @param $value
     * @return mixed
     */
    public function find($field, $value)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::where($field, '=', $value)->first();

        if (!$model) throw new \InvalidArgumentException('Entry not found');

        return $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert($data)
    {
        $modelClass = $this->modelClass;
        return $modelClass::create($data);

    }
}