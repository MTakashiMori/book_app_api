<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends AbstractController
{

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
