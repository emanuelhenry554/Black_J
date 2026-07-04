<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create admin user for local testing
        $this->call(AdminUserSeeder::class);

        // Seed sample categories and products
        if (class_exists(\Database\Seeders\ProductSeeder::class)) {
            $this->call(\Database\Seeders\ProductSeeder::class);
        }
    }
}
