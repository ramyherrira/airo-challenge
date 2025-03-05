<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'SUPER DUPER ADMIN',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => '$2y$12$y5.cVKBgic.csjcTlIMnQ.pwXKt8nGXrEN9nBWU.0hAglwMOMFpTu', // very_secret
        ]);
    }
}
