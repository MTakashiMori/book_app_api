<?php

namespace App\Repositories;

use App\Models\Book;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository extends AbstractRepository
{
    /**
     * BookRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        $this->model = $model;
        $this->relationship = [];
    }

}
