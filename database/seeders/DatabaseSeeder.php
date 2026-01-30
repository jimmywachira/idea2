<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
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
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::Admin,
        ]);

        // Create moderator user
        User::factory()->create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::Moderator,
        ]);

        // Create regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::User,
        ]);

        // Seed additional users
        User::factory(5)->create([
            'role' => UserRole::User,
        ]);

        // Seed the rest of the sample data
        $this->call([
            IdeaSeeder::class,
        ]);
    }
}
