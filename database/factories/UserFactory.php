<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    private array $professionalBios = [
        'Full-stack developer passionate about building scalable web applications',
        'Product manager focused on user-centric design and innovation',
        'DevOps engineer specializing in cloud infrastructure and automation',
        'Data scientist using machine learning to solve real-world problems',
        'UX/UI designer creating beautiful and functional digital experiences',
        'Backend engineer building robust APIs and microservices',
        'Frontend developer crafting interactive user interfaces',
        'Mobile app developer creating native iOS and Android apps',
        'Security engineer protecting systems and data from threats',
        'ML Engineer implementing cutting-edge AI solutions',
        'Solutions architect designing enterprise systems',
        'Technical lead mentoring teams and setting technical vision',
        'Startup founder building the next unicorn',
        'Open source contributor to popular projects',
        'Cloud architect specializing in AWS and Kubernetes',
        'Database administrator optimizing performance and reliability',
        'QA engineer ensuring software quality and reliability',
        'Technical writer documenting complex systems clearly',
        'Growth hacker using data to accelerate business growth',
        'CTO at fast-growing SaaS company',
    ];

    private array $firstNames = [
        'James', 'Sarah', 'Michael', 'Emma', 'David', 'Olivia', 'Robert', 'Ava',
        'William', 'Isabella', 'Richard', 'Mia', 'Joseph', 'Charlotte', 'Thomas',
        'Amelia', 'Charles', 'Harper', 'Christopher', 'Evelyn', 'Daniel', 'Abigail',
        'Matthew', 'Avery', 'Anthony', 'Elizabeth', 'Mark', 'Ella', 'Donald', 'Scarlett',
        'Steven', 'Grace', 'Paul', 'Chloe', 'Andrew', 'Victoria', 'Joshua', 'Madison',
        'Kevin', 'Sophia', 'Brian', 'Natalie', 'George', 'Lily', 'Edward', 'Nora',
    ];

    private array $lastNames = [
        'Anderson', 'Chen', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller',
        'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson',
        'Moore', 'Taylor', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin', 'Thompson',
        'Singh', 'Patel', 'Kumar', 'Shah', 'Kim', 'Park', 'Lee', 'Nguyen', 'Tran',
        'Sharma', 'Desai', 'Verma', 'Agarwal', 'Gupta', 'Rahman', 'Hassan', 'Ahmed',
        'Murphy', 'O\'Brien', 'Sullivan', 'O\'Connor', 'Flanagan', 'Kelly', 'Donnelly',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->randomElement($this->firstNames);
        $lastName = $this->faker->randomElement($this->lastNames);

        return [
            'name' => "$firstName $lastName",
            'email' => strtolower("$firstName.$lastName." . $this->faker->unique()->numerify('####')) . '@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'bio' => $this->faker->randomElement($this->professionalBios),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
