<?php

namespace Database\Seeders;

use App\Models\Product;

use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(10)->create();
        Product::factory(20)->create(); 
    }
}
