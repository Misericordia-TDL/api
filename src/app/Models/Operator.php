<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Models {

    use MongoDB\InsertOneResult;
    use MongoDB\Model\BSONDocument;
    use MongoDB\UpdateResult;
    use MongoDB\BSON\ObjectID;

    /**
     * Class Operator
     * @package App\Models
     *
     * @author Javier Mellado <sol@javiermellado.com>
     */
    class Operator extends AbstractModel
    {


        /**
         * @param $data
         * @return InsertOneResult
         */
        public function insert($data): InsertOneResult
        {
            return $this->persist($data, ['join_date']);
        }

        /**
         * @param $data
         * @return UpdateResult
         */
        public function update($data): UpdateResult
        {
            $id = $data['_id'];
            unset($data['_id']);

            return $this->collection->updateOne(
                ['_id' => new ObjectID($id)],
                ['$set' => $data]
            );
        }

        /**
         * @return array
         */
        public function getAll(): array
        {
            return $this->findAll('active');
        }

        /**
         * @param $id
         * @return UpdateResult
         */
        public function delete($id): UpdateResult
        {
            return $this->update(['_id' => 'poo', 'active' => 0]);
        }

        /**
         * @param string $email
         * @return BSONDocument
         */
        public function findByEmail(string $email)
        {
            return $this->collection->findOne(['email' => $email]);
        }
    }
}