<?php

namespace database\seeders;

use App\Models\Book;
use App\Services\CategoryService;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{

    private $categoryService;

    /**
     * BookSeeder constructor.
     * @param $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function run()
    {
        collect([
            'The man in the light',
            'Lupin Hood, the tax collector',
            'Star Peace',
            'Sailors of Nilo',
            'Thief of sun'
        ])->each(function ($item) {
            Book::factory()->create([
                'name' => $item,
                'category_id' => $this->categoryService->random()
            ]);
        });
    }

}
