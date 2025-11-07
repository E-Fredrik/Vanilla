<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in the correct order
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,  // Must run before ProductSeeder
            ProductSeeder::class,
            TestimonySeeder::class,
        ]);
    }
}
