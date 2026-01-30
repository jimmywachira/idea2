<?php

namespace Database\Seeders;

use App\IdeaStatus;
use App\Models\Idea;
use App\Models\Step;
use App\Models\User;
use App\Models\Comment;
use App\Models\IdeaLike;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create professional users with diverse backgrounds
        $users = User::factory()->count(20)->create();

        // For each user, create ideas with realistic data
        $users->each(function (User $user) use ($users) {
            $ideaCount = rand(1, 4);
            
            $ideas = Idea::factory()
                ->count($ideaCount)
                ->for($user)
                ->create();

            $ideas->each(function (Idea $idea) use ($users) {
                // Assign realistic statuses
                $statuses = IdeaStatus::cases();
                $idea->update([
                    'status' => $statuses[array_rand($statuses)]->value,
                ]);

                // Create 2-6 implementation steps
                Step::factory()
                    ->count(rand(2, 6))
                    ->create(['idea_id' => $idea->id]);

                // Add 1-5 professional comments from other users
                $commentersCount = rand(1, 5);
                $commenters = $users->random($commentersCount);
                
                $commenters->each(function (User $commenter) use ($idea) {
                    Comment::factory()
                        ->for($idea)
                        ->for($commenter, 'user')
                        ->create();
                });

                // Add realistic likes (5-20 likes per idea)
                $likeCount = rand(5, 20);
                $likers = $users->random($likeCount);
                
                $likers->each(function (User $liker) use ($idea) {
                    IdeaLike::create([
                        'user_id' => $liker->id,
                        'idea_id' => $idea->id,
                    ]);
                });
            });
        });
    }
}
