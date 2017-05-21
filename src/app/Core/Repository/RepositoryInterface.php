<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Repository;

use Illuminate\Support\Collection;

/**
 * Class AbstractRepository
 * @package App\Core\Repository
 * @author Javier Mellado <sol@javiermellado.com>
 */
interface RepositoryInterface
{
    const ELEMENTS_PER_PAGE = 3;

    /**
     * AbstractRepository constructor.
     * @param string $modelClassName
     */
    function __construct(string $modelClassName);

    /**
     * @param int $page
     * @param int $perPage
     * @return Collection
     */
    public function getAll($page = 0, $perPage = self::ELEMENTS_PER_PAGE);

    /**
     * @param string $id
     * @return mixed
     */
    public function delete(string $id);

    /**
     * @param string $id
     * @return mixed
     */
    public function findById(string $id);

    /**
     * @param string $id
     * @return mixed
     */
    public function findByName(string $id);

    /**
     * @param string $field
     * @param string $value
     * @return mixed
     */
    public function find(string $field, string $value);

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);
    /**
     * Get total pages
     * @return float|int
     */
    public function getTotalPages();

    /**
     * Get total documents in the collection
     */
    public function getTotalCount();
}
