<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService extends AbstractService
{

    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
