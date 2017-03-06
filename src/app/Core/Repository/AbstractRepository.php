<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Repository;

/**
 * Class AbstractRepository
 * @package App\Core\Repository
 */
class AbstractRepository
{
    /**
     * @var string
     */
    protected $modelClass = null;

    /**
     * AbstractRepository constructor.
     * @param string $modelClassName
     */
    function __construct(string $modelClassName)
    {
        $this->modelClass = $modelClassName;
    }

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
    public function delete(string $id)
    {

        $model = $this->findById($id);

        return $model->delete();

    }

    /**
     * @param string $id
     * @return mixed
     */
    public function findById(string $id)
    {
        return $this->find('_id', $id);
    }

    /**
     * @param string $field
     * @param string $value
     * @return mixed
     */
    public function find(string $field, string $value)
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
    public function insert(array $data)
    {
        $modelClass = $this->modelClass;
        return $modelClass::create($data);

    }
}