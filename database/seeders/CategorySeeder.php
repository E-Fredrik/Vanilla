<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Cakes",
            "description" => "Delicious and beautifully decorated cakes for all occasions.",
        ]);
        Category::create([
            "name" => "Pastries",
            "description" => "A variety of flaky and buttery pastries to satisfy your cravings.",
        ]);
        Category::create([
            "name" => "Breads",
            "description" => "Freshly baked breads with a perfect crust and soft interior.",
        ]);
    }
}
