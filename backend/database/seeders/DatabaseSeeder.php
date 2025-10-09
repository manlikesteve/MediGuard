<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "🚀 Starting database seeding...\n";

        User::updateOrCreate(
            ['email' => 'admin@mediguard.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'analyst@mediguard.com'],
            [
                'name' => 'Network Analyst',
                'password' => Hash::make('Analyst123!'),
                'role' => 'analyst',
            ]
        );

        echo "✅ Admin and Analyst users seeded successfully!\n";
    }
}