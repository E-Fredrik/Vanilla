<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $cakes = Category::where('name', 'Cakes')->first();
        $pastries = Category::where('name', 'Pastries')->first();
        $breads = Category::where('name', 'Breads')->first();

        // Create products
        $chocolatePudding = Product::create([
            'name' => 'Chocolate Pudding',
            'description' => 'A sweet and creamy chocolate pudding made with high-quality cocoa.',
            'price' => 2000,
            'ingredients' => 'Milk, sugar, cocoa powder, cornstarch, vanilla extract',
            'imagePath' => 'images/Chocolate_Pudding.png',
        ]);
        $chocolatePudding->categories()->attach([$cakes->id]);

        $chocolateDonut = Product::create([
            'name' => 'Chocolate Donut',
            'description' => 'A soft and fluffy donut coated with rich chocolate glaze.',
            'price' => 15000,
            'ingredients' => 'Flour, sugar, eggs, butter, milk, cocoa powder, yeast, salt',
            'imagePath' => 'images/Donut.png',
        ]);
        $chocolateDonut->categories()->attach([$pastries->id]);

        $eclairChocolate = Product::create([
            'name' => 'Eclair Chocolate',
            'description' => 'A classic French pastry filled with rich chocolate cream.',
            'price' => 8000,
            'ingredients' => 'Flour, sugar, eggs, butter, milk, chocolate, cream',
            'imagePath' => 'images/Eclair.png',
        ]);
        $eclairChocolate->categories()->attach([$pastries->id]);

        $garlicBread = Product::create([
            'name' => 'Garlic Bread',
            'description' => 'A crispy bread topped with garlic butter and herbs.',
            'price' => 10000,
            'ingredients' => 'Flour, garlic, butter, parsley, yeast, salt',
            'imagePath' => 'images/Garlic_Bread.png',
        ]);
        $garlicBread->categories()->attach([$breads->id]);

        $sausageBread = Product::create([
            'name' => 'Sausage Bread',
            'description' => 'A savory bread filled with juicy sausage.',
            'price' => 10000,
            'ingredients' => 'Flour, sausage, cheese, eggs, milk, butter',
            'imagePath' => 'images/Sausage_Bread.png',
        ]);
        $sausageBread->categories()->attach([$breads->id]);

        $sausageBrood = Product::create([
            'name' => 'Sausage Brood',
            'description' => 'A savory bread filled with juicy sausage and topped with cheese.',
            'price' => 10000,
            'ingredients' => 'Flour, sausage, cheese, eggs, milk, butter, yeast, salt',
            'imagePath' => 'images/Sausage_Brood.png',
        ]);
        $sausageBrood->categories()->attach([$breads->id]);

        $blackCreamCheeseCake = Product::create([
            'name' => 'Black Cream Cheese Cake',
            'description' => 'A rich and creamy cheesecake with a chocolate crust.',
            'price' => 10000,
            'ingredients' => 'Flour, cream cheese, sugar, eggs, butter, cocoa powder',
            'imagePath' => 'images/Cake_ketan_hitam_cream_cheese.png',
        ]);
        $blackCreamCheeseCake->categories()->attach([$cakes->id]);

        $chocolateBananaBread = Product::create([
            'name' => 'Chocolate Banana Bread',
            'description' => 'A moist banana bread with chunks of chocolate.',
            'price' => 7000,
            'ingredients' => 'Flour, bananas, sugar, eggs, butter, chocolate chips',
            'imagePath' => 'images/Chocolate_Banana_Bread.png',
        ]);
        $chocolateBananaBread->categories()->attach([$breads->id]);

        $chocolateChoux = Product::create([
            'name' => 'Chocolate Choux',
            'description' => 'A light pastry filled with rich chocolate cream.',
            'price' => 10000,
            'ingredients' => 'Flour, butter, chocolate, sugar, eggs, milk',
            'imagePath' => 'images/Chocolate_Choux.png',
        ]);
        $chocolateChoux->categories()->attach([$pastries->id]);

        $shreddedBeefBread = Product::create([
            'name' => 'Shredded Beef Bread',
            'description' => 'A savory bread filled with tender shredded beef.',
            'price' => 10000,
            'ingredients' => 'Flour, shredded beef, garlic, eggs, milk, butter',
            'imagePath' => 'images/Shredded_Beef_Bread.png',
        ]);
        $shreddedBeefBread->categories()->attach([$breads->id]);
    }
}