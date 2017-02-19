<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace App\Models;

use App\Models\Base\CommonTrait;
use App\Models\Exception\EmptyDataSetException;
use MongoDB\BSON\ObjectID;
use MongoDB\Collection;
use MongoDB\InsertOneResult;

/**
 * Class AbstractModel
 * @package App\Models
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class AbstractModel
{
    use CommonTrait;

    /**
     * @var \MongoDB\Collection
     */
    protected $collection;

    /**
     *
     * Refugee constructor.
     * @param Collection $collection
     */
    function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function findAll() : array
    {
        return $this->collection->find()->toArray();
    }

    /**
     * @param $id
     * @return array
     */
    public function findById($id) : array
    {
        $mongoId = new ObjectID($id);
        return $this->collection->find(['_id' => $mongoId])->toArray();
    }

    /**
     * @param $data
     * @return mixed
     */
    abstract function insert($data);

    /**
     * @param array $data
     * @param array $dateFields
     * @return InsertOneResult
     * @throws \Exception
     */
    public function persist(array $data, array $dateFields = []) : InsertOneResult
    {
        if(empty($data)){
            throw new EmptyDataSetException('data set provided to persist is empty');
        }
        if (!empty($dateFields)) {
            $this->prepareDateFields($data,$dateFields);
        }
        return $this->collection->insertOne($data);
    }
}