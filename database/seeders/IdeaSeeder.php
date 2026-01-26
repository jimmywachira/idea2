<?php

namespace Database\Seeders;

use App\IdeaStatus;
use App\Models\Idea;
use App\Models\Step;
use App\Models\User;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a batch of users
        $users = User::factory()->count(10)->create();

        // For each user, create some ideas and related steps
        $users->each(function (User $user) {
            $ideas = Idea::factory()
                ->count(fake()->numberBetween(2, 5))
                ->for($user)
                ->create();

            $ideas->each(function (Idea $idea) {
                // Randomize status when available
                $statuses = IdeaStatus::cases();
                $idea->update([
                    'status' => $statuses[array_rand($statuses)]->value,
                ]);

                // Attach 2-5 steps per idea
                Step::factory()
                    ->count(fake()->numberBetween(2, 5))
                    ->create([
                        'idea_id' => $idea->id,
                    ]);
            });
        });
    }
}
