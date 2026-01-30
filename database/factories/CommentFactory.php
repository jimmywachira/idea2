<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    private array $professionalComments = [
        'Great idea! I\'d love to collaborate on the technical implementation. This could really solve a lot of pain points.',
        'Have you considered the scalability aspects? We might need to think about distributed systems if this gets large.',
        'The concept is solid, but I think we should explore alternative approaches for the data layer. Let\'s discuss.',
        'This has tremendous potential. I\'d be happy to help with the architecture design and infrastructure setup.',
        'Excellent execution on the MVP. The next phase should focus on performance optimization and user feedback integration.',
        'Really impressed with the approach here. Have you thought about accessibility and compliance requirements?',
        'I\'ve seen similar solutions in the market, but your angle is unique. The differentiator is clear.',
        'Love the problem statement. Could we add analytics to better understand user behavior and engagement?',
        'This aligns perfectly with market trends. The timing for launch is crucial though. Let\'s plan accordingly.',
        'The technical stack looks solid. One suggestion: consider microservices for better modularity and scaling.',
        'I\'m interested in the business model. Have you done customer discovery to validate the assumptions?',
        'The UI/UX design is clean and intuitive. I\'d recommend user testing before full rollout.',
        'This could be a game-changer in the industry. I\'d like to discuss potential partnerships.',
        'Brilliant solution to a common problem. Security and data privacy should be top priorities.',
        'The roadmap is comprehensive. I\'d prioritize the core features first and iterate based on user feedback.',
        'I\'m currently working on something similar. Would love to exchange ideas and potentially collaborate.',
        'The code quality looks good. I\'d suggest adding more comprehensive test coverage for edge cases.',
        'Impressed with the results so far. What\'s your customer acquisition strategy?',
        'This approach simplifies complex workflows significantly. The ROI potential is substantial.',
        'Great presentation of the idea. I think the biggest challenge will be market adoption. How are you planning to tackle that?',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'idea_id' => Idea::factory(),
            'body' => $this->faker->randomElement($this->professionalComments),
        ];
    }
}
