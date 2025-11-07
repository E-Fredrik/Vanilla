<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@vanillabakery.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
            ]
        );
    }
}