<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimony;
use App\Models\Product;

class TestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some products
        $chocolatePudding = Product::where('name', 'Chocolate Pudding')->first();
        $chocolateDonut = Product::where('name', 'Chocolate Donut')->first();
        $eclairChocolate = Product::where('name', 'Eclair Chocolate')->first();
        $garlicBread = Product::where('name', 'Garlic Bread')->first();

        // General testimonies (not tied to specific products)
        Testimony::create([
            'name' => 'Elifele Fredrik',
            'content' => 'The cakes here are very delicious, and the prices are affordable',
            'status' => 'approved',
        ]);

        Testimony::create([
            'name' => 'Stevanus Ivan Santoso',
            'content' => 'Affordable Pricing!',
            'status' => 'approved',
        ]);

        Testimony::create([
            'name' => 'Nicholas Gerwin Mawardji',
            'content' => 'The owners are very nice!',
            'status' => 'approved',
        ]);

        // Product-specific testimonies
        if ($chocolatePudding) {
            Testimony::create([
                'product_id' => $chocolatePudding->id,
                'name' => 'Kenneth Jonathan Halim',
                'content' => 'Wenak Pol! The chocolate pudding is absolutely amazing!',
                'status' => 'approved',
            ]);
        }

        if ($chocolateDonut) {
            Testimony::create([
                'product_id' => $chocolateDonut->id,
                'name' => 'Keane Juan Suryanto',
                'content' => 'Mantap Jiwa! Best donuts in town!',
                'status' => 'approved',
            ]);
        }

        if ($eclairChocolate) {
            Testimony::create([
                'product_id' => $eclairChocolate->id,
                'name' => 'Bryan Carlie Lukito Setiawan',
                'content' => 'Recommended! The eclair is perfectly filled with rich chocolate cream.',
                'status' => 'approved',
            ]);
        }

        if ($garlicBread) {
            Testimony::create([
                'product_id' => $garlicBread->id,
                'name' => 'Sarah Martinez',
                'content' => 'The garlic bread is crispy on the outside and soft inside. Perfect!',
                'status' => 'approved',
            ]);
        }
    }
}
