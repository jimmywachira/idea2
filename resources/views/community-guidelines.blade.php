<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-base-50 to-base-100">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-warning to-warning/80 text-white py-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Community Guidelines</h1>
                <p class="text-lg text-white/90">Standards for creating a respectful, inclusive, and productive community</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-4xl mx-auto px-4 py-12">
            <!-- Introduction -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <p class="text-base-content/80 leading-relaxed text-lg">
                    IdeaBoard is a collaborative platform designed to foster innovation and creativity. To maintain a positive environment for all users, we've established these community guidelines. By using IdeaBoard, you agree to follow these standards.
                </p>
            </div>

            <!-- Be Respectful -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-4 flex items-center gap-2">
                    <ion-icon name="heart" class="text-error text-4xl"></ion-icon>
                    Be Respectful
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Treat all members with respect and dignity</li>
                        <li>Disagree constructively without personal attacks</li>
                        <li>Listen to different perspectives and ideas</li>
                        <li>Use inclusive and welcoming language</li>
                        <li>Don't harass, bully, or discriminate against anyone</li>
                    </ul>
                </div>
            </div>

            <!-- Keep It Professional -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-4 flex items-center gap-2">
                    <ion-icon name="briefcase" class="text-primary text-4xl"></ion-icon>
                    Keep It Professional
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Post ideas and feedback relevant to your professional growth</li>
                        <li>Avoid spam, self-promotion, and commercial advertising</li>
                        <li>Don't post copyrighted or proprietary information without permission</li>
                        <li>Verify facts before sharing information</li>
                        <li>Provide constructive feedback, not just criticism</li>
                    </ul>
                </div>
            </div>

            <!-- Respect Privacy -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-4 flex items-center gap-2">
                    <ion-icon name="shield" class="text-success text-4xl"></ion-icon>
                    Respect Privacy
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Don't share personal information about other users</li>
                        <li>Respect intellectual property and confidentiality agreements</li>
                        <li>Don't post without consent from all involved parties</li>
                        <li>Be mindful of what information you share about yourself</li>
                        <li>Report privacy violations to our moderation team</li>
                    </ul>
                </div>
            </div>

            <!-- Prohibited Content -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-4 flex items-center gap-2">
                    <ion-icon name="ban" class="text-error text-4xl"></ion-icon>
                    Prohibited Content
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <p class="font-semibold mb-3">The following are strictly prohibited:</p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Hate speech, discrimination, or harassment</li>
                        <li>Violence or threats of violence</li>
                        <li>Explicit sexual content</li>
                        <li>Spam or malicious links</li>
                        <li>Illegal content or activities</li>
                        <li>Misinformation or deliberate falsehoods</li>
                        <li>Doxxing or sharing private information</li>
                    </ul>
                </div>
            </div>

            <!-- Enforcement -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-4 flex items-center gap-2">
                    <ion-icon name="settings" class="text-accent text-4xl"></ion-icon>
                    Enforcement
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <p>Violations of these guidelines may result in:</p>
                    <ul class="list-disc list-inside space-y-2 mt-3">
                        <li><strong>Warning:</strong> First violation with a reminder of guidelines</li>
                        <li><strong>Suspension:</strong> Temporary removal of posting privileges</li>
                        <li><strong>Banning:</strong> Permanent removal from the platform</li>
                    </ul>
                    <p className="mt-4">We review reports on a case-by-case basis and maintain the right to enforce these guidelines at our discretion.</p>
                </div>
            </div>

            <!-- Report Violations -->
            <div class="bg-gradient-to-r from-warning/10 to-error/10 rounded-2xl p-8 border border-warning/20">
                <h3 class="text-2xl font-bold mb-3 flex items-center gap-2">
                    <ion-icon name="alert-circle" class="text-warning text-4xl"></ion-icon>
                    Report Violations
                </h3>
                <p class="text-base-content/70 mb-4">If you see content that violates these guidelines, please report it to our moderation team. Include relevant details and screenshots if possible.</p>
                <a href="mailto:moderation@ideaboard.com" class="btn btn-warning">
                    <ion-icon name="mail"></ion-icon>
                    Report Violation
                </a>
            </div>
        </div>
    </div>
</x-layout>
