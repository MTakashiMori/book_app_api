<?php

namespace App\Services;

use App\Repositories\BookRepository;

/**
 * Class BookService
 * @package App\Services
 */
class BookService extends AbstractService
{
    /**
     * BookService constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }
}
