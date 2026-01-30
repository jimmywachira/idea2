<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    private array $professionIdeas = [
        [
            'title' => 'AI-Powered Chatbot for Customer Support',
            'description' => 'Build an intelligent chatbot that uses GPT-4 to handle customer inquiries 24/7, reducing support team workload by 40%. The system should include natural language processing, multi-language support, and seamless handoff to human agents when needed.',
            'links' => ['https://github.com/openai/gpt-4', 'https://platform.openai.com/docs'],
        ],
        [
            'title' => 'Real-time Collaboration Dashboard',
            'description' => 'Create a collaborative workspace where teams can work together on projects in real-time. Features include live cursors, threaded comments, version history, granular permissions, and seamless integration with Slack and Microsoft Teams.',
            'links' => ['https://github.com/yjs/yjs', 'https://socket.io/docs/'],
        ],
        [
            'title' => 'Sustainable E-commerce Platform',
            'description' => 'Develop an eco-friendly marketplace connecting sustainable brands with conscious consumers. Include carbon footprint tracking, supply chain transparency, renewable energy usage metrics, and carbon-neutral shipping options with real-time calculation.',
            'links' => ['https://stripe.com/docs/payments', 'https://shopify.dev/api'],
        ],
        [
            'title' => 'Mental Health Support Mobile App',
            'description' => 'Build a comprehensive therapy and mental health tracking app with AI-powered mood analysis, personalized meditation guides, professional therapist connections, and peer support communities. Include HIPAA compliance and crisis intervention features.',
            'links' => ['https://firebase.google.com/docs', 'https://developer.apple.com/healthkit/'],
        ],
        [
            'title' => 'Blockchain-Based Supply Chain Solution',
            'description' => 'Create a transparent supply chain system using blockchain to track product origin, authenticity, and journey from manufacturer to consumer. Perfect for luxury goods, pharmaceuticals, and food products. Includes cryptographic QR code verification.',
            'links' => ['https://ethereum.org/developers', 'https://hardhat.org/docs'],
        ],
        [
            'title' => 'EdTech Platform with Adaptive Learning',
            'description' => 'Develop an interactive learning platform with gamification, AI-powered adaptive learning paths, real-time progress analytics, and teacher dashboards. Support multiple learning styles and include parent engagement tools for K-12 education.',
            'links' => ['https://github.com/canvas-lms', 'https://docs.moodle.org/'],
        ],
        [
            'title' => 'IoT Smart Home Automation System',
            'description' => 'Build a comprehensive smart home platform controlling lights, climate, security systems, and appliances through a unified interface. Include voice control, automation rules, energy monitoring with AI optimization, and mobile app with offline support.',
            'links' => ['https://www.home-assistant.io/developers/', 'https://docs.arduino.cc/'],
        ],
        [
            'title' => 'AI-Powered Talent Matching Platform',
            'description' => 'Create an intelligent job board using machine learning to match candidates with ideal roles based on skills, culture fit, and growth potential. Include salary prediction, skill gap analysis, career pathing recommendations, and automated screening.',
            'links' => ['https://developers.linkedin.com/', 'https://huggingface.co/models'],
        ],
        [
            'title' => 'Personalized Fitness & Nutrition App',
            'description' => 'Develop a comprehensive fitness ecosystem with AI-driven workout personalization, macro-based nutrition planning, wearable device integration, virtual coaching, and social challenges. Include VO2 max tracking and injury prevention algorithms.',
            'links' => ['https://developers.google.com/fit', 'https://www.fitbit.com/oauth2/'],
        ],
        [
            'title' => 'Virtual Real Estate with AR Visualization',
            'description' => 'Build a real estate platform featuring AR property tours, 3D walkthroughs, neighborhood analytics with crime data, school ratings, and future development plans. Include virtual staging and integration with mortgage calculators and insurance providers.',
            'links' => ['https://developers.google.com/ar', 'https://zillow.com/developers/'],
        ],
        [
            'title' => 'Carbon Footprint Tracking Dashboard',
            'description' => 'Create a personal and corporate carbon tracking tool that analyzes daily activities, purchases, and travel. Provide AI-powered recommendations for reducing emissions, track impact over time, and enable community challenges with real environmental impact metrics.',
            'links' => ['https://www.ipcc.ch/report/', 'https://www.epa.gov/carbon-footprint-calculator'],
        ],
        [
            'title' => 'Enterprise Content Generation Suite',
            'description' => 'Build an AI-powered platform for marketers to generate blog posts, social media content, email campaigns, and ad copy with brand voice consistency. Include SEO optimization, competitor analysis, A/B testing, and performance analytics dashboard.',
            'links' => ['https://platform.openai.com/', 'https://github.com/huggingface/transformers'],
        ],
        [
            'title' => 'Decentralized Knowledge Sharing Network',
            'description' => 'Create a Web3 platform where experts share knowledge through tokenized content. Include reputation systems, micro-credentials, community moderation, and revenue sharing for creators with blockchain-based payments and smart contracts.',
            'links' => ['https://docs.web3.py/', 'https://solidity.readthedocs.io/'],
        ],
        [
            'title' => 'Data Privacy & Security Audit Tool',
            'description' => 'Develop a comprehensive security audit platform that scans applications for vulnerabilities, compliance gaps (GDPR, CCPA, SOC2), and data privacy risks. Include automated remediation suggestions and continuous monitoring with real-time alerts.',
            'links' => ['https://owasp.org/www-project-top-ten/', 'https://github.com/aquasecurity/trivy'],
        ],
        [
            'title' => 'AI Video Analytics Platform',
            'description' => 'Build a video intelligence platform for security, retail analytics, and traffic monitoring using computer vision. Features include object detection, behavior recognition, heat mapping, and predictive insights with real-time dashboards and API access.',
            'links' => ['https://docs.opencv.org/', 'https://cloud.google.com/vision/docs'],
        ],
    ];

    private array $resourceLinks = [
        'https://github.com/',
        'https://stackoverflow.com/questions',
        'https://medium.com/tag/engineering',
        'https://dev.to/',
        'https://www.youtube.com/watch?v=',
        'https://docs.microsoft.com/',
        'https://aws.amazon.com/documentation/',
        'https://cloud.google.com/docs',
        'https://www.digitalocean.com/docs/',
        'https://kubernetes.io/docs/',
        'https://docker.com/docs',
        'https://www.postgresql.org/docs/',
        'https://mongodb.com/docs/',
        'https://redis.io/documentation',
        'https://www.elastic.co/guide/',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $idea = $this->faker->randomElement($this->professionIdeas);
        
        return [
            'user_id' => User::factory(),
            'title' => $idea['title'],
            'description' => $idea['description'],
            'links' => $this->generateRealisticLinks(),
        ];
    }

    private function generateRealisticLinks(): array
    {
        $link1 = $this->faker->randomElement($this->resourceLinks);
        $link2 = $this->faker->randomElement($this->resourceLinks);
        
        // Ensure different links
        while ($link2 === $link1) {
            $link2 = $this->faker->randomElement($this->resourceLinks);
        }
        
        return [$link1, $link2];
    }
}
