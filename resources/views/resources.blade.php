<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-base-50 to-base-100">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary to-primary/80 text-white py-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Resources</h1>
                <p class="text-lg text-white/90">Everything you need to get started and make the most of IdeaBoard</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-4xl mx-auto px-4 py-12">
            <!-- Getting Started -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                    <ion-icon name="rocket" class="text-primary text-4xl"></ion-icon>
                    Getting Started
                </h2>
                <div class="space-y-4 text-base-content/80 leading-relaxed">
                    <p>Welcome to IdeaBoard! Here are the first steps to get you up and running:</p>
                    <ul class="list-disc list-inside space-y-2 ml-2">
                        <li>Create your account with a valid email</li>
                        <li>Complete your profile with a bio and profile picture</li>
                        <li>Post your first idea using the "Create Idea" button</li>
                        <li>Join or create teams to collaborate with others</li>
                        <li>Share ideas with your teams and get feedback</li>
                    </ul>
                </div>
            </div>

            <!-- Features Guide -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                    <ion-icon name="star" class="text-secondary text-4xl"></ion-icon>
                    Key Features
                </h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="border-l-4 border-primary pl-4">
                        <h3 class="font-bold text-lg mb-2">💡 Share Ideas</h3>
                        <p class="text-base-content/70">Post your innovative ideas with descriptions, images, and steps to implement them.</p>
                    </div>
                    <div class="border-l-4 border-secondary pl-4">
                        <h3 class="font-bold text-lg mb-2">👥 Build Teams</h3>
                        <p class="text-base-content/70">Create teams and invite collaborators to work together on shared ideas.</p>
                    </div>
                    <div class="border-l-4 border-accent pl-4">
                        <h3 class="font-bold text-lg mb-2">💬 Get Feedback</h3>
                        <p class="text-base-content/70">Receive constructive comments and suggestions from the community.</p>
                    </div>
                    <div class="border-l-4 border-success pl-4">
                        <h3 class="font-bold text-lg mb-2">📊 Track Progress</h3>
                        <p class="text-base-content/70">Monitor your ideas from conception through implementation.</p>
                    </div>
                </div>
            </div>

            <!-- Best Practices -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                    <ion-icon name="checkmark-circle" class="text-success text-4xl"></ion-icon>
                    Best Practices
                </h2>
                <div class="space-y-4 text-base-content/80">
                    <div class="bg-base-50 p-4 rounded-lg">
                        <p class="font-semibold mb-2">📝 Clear Descriptions</p>
                        <p>Write clear, concise descriptions that explain your idea and why it matters.</p>
                    </div>
                    <div class="bg-base-50 p-4 rounded-lg">
                        <p class="font-semibold mb-2">🤝 Collaborate Respectfully</p>
                        <p>Be respectful in comments and feedback, even when you disagree.</p>
                    </div>
                    <div class="bg-base-50 p-4 rounded-lg">
                        <p class="font-semibold mb-2">🎯 Set Goals</p>
                        <p>Define clear steps and milestones to track your idea's progress.</p>
                    </div>
                    <div class="bg-base-50 p-4 rounded-lg">
                        <p class="font-semibold mb-2">🔄 Iterate & Improve</p>
                        <p>Welcome feedback and update your ideas based on community input.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-base-200">
                <h2 class="text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                    <ion-icon name="help-circle" class="text-accent text-4xl"></ion-icon>
                    Frequently Asked Questions
                </h2>
                <div class="space-y-4">
                    <div class="collapse collapse-plus border border-base-300 bg-base-50">
                        <input type="radio" name="faq" />
                        <div class="collapse-title font-bold">How do I delete my account?</div>
                        <div class="collapse-content">
                            <p>You can delete your account from your profile settings. Note that this action is permanent and cannot be undone.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-plus border border-base-300 bg-base-50">
                        <input type="radio" name="faq" />
                        <div class="collapse-title font-bold">Can I make my ideas private?</div>
                        <div class="collapse-content">
                            <p>Currently, all ideas are public. We're working on private sharing options for the future.</p>
                        </div>
                    </div>
                    <div class="collapse collapse-plus border border-base-300 bg-base-50">
                        <input type="radio" name="faq" />
                        <div class="collapse-title font-bold">How do teams work?</div>
                        <div class="collapse-content">
                            <p>Teams allow you to collaborate with others. Team owners can manage members and shared ideas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="mt-12 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-8 border border-primary/20 text-center">
                <h3 class="text-2xl font-bold mb-3">Need More Help?</h3>
                <p class="text-base-content/70 mb-6">Couldn't find what you're looking for? Contact our support team.</p>
                <a href="mailto:support@ideaboard.com" class="btn btn-primary">
                    <ion-icon name="mail"></ion-icon>
                    Email Support
                </a>
            </div>
        </div>
    </div>
</x-layout>
