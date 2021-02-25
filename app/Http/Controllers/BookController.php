<?php

namespace App\Http\Controllers;

use App\Services\BookService;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends AbstractController
{

    /**
     * BookController constructor.
     * @param BookService $service
     */
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }
}
