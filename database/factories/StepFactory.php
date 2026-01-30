<?php

namespace Database\Factories;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    private array $stepTemplates = [
        'Design the system architecture and technology stack',
        'Create wireframes and UI mockups for the application',
        'Set up development environment and project scaffolding',
        'Implement core API endpoints and database schemas',
        'Build responsive frontend components',
        'Integrate third-party APIs and authentication providers',
        'Write comprehensive unit and integration tests',
        'Implement caching and performance optimization',
        'Set up CI/CD pipeline and automated deployments',
        'Configure monitoring, logging, and error tracking',
        'Conduct security audit and penetration testing',
        'Prepare documentation and deployment guides',
        'Implement analytics and usage tracking',
        'Build admin dashboard and management tools',
        'Create data migration scripts from legacy systems',
        'Optimize database queries and indexing',
        'Implement real-time notifications and WebSocket support',
        'Add multi-language localization support',
        'Create backup and disaster recovery procedures',
        'Conduct user acceptance testing (UAT)',
        'Deploy to production environment',
        'Monitor performance and gather user feedback',
        'Implement machine learning features',
        'Add advanced search and filtering capabilities',
        'Create mobile app version',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idea_id' => Idea::factory(),
            'description' => $this->faker->randomElement($this->stepTemplates),
            'completed' => $this->faker->boolean(30), // 30% chance of being completed
        ];
    }
}
