<?php

namespace database\seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {

        collect(['Romance', 'Drama', ' Horror', 'Fantasy'])->each(function ($item) {
            Category::factory()->create([
                'name' => $item
            ]);
        });

    }

}
