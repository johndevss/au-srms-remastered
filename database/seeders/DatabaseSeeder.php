<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create admin user for Filament
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@au.edu.ph',
        ]);

        // Seed students
        $this->call([
            StudentSeeder::class,
        ]);
    }
}
