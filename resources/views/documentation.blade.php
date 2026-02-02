<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-base-50 to-base-100">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-secondary to-secondary/80 text-white py-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Documentation</h1>
                <p class="text-lg text-white/90">Complete guide to IdeaBoard features and functionality</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-4xl mx-auto px-4 py-12">
            <!-- Table of Contents -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200">
                <h2 class="text-2xl font-bold mb-4">Table of Contents</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <a href="#users" class="p-3 hover:bg-primary/10 rounded-lg transition text-primary font-semibold">→ User Management</a>
                    <a href="#ideas" class="p-3 hover:bg-primary/10 rounded-lg transition text-primary font-semibold">→ Managing Ideas</a>
                    <a href="#teams" class="p-3 hover:bg-primary/10 rounded-lg transition text-primary font-semibold">→ Teams & Collaboration</a>
                    <a href="#comments" class="p-3 hover:bg-primary/10 rounded-lg transition text-primary font-semibold">→ Comments & Feedback</a>
                </div>
            </div>

            <!-- User Management -->
            <div id="users" class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200 scroll-mt-20">
                <h2 class="text-3xl font-bold text-base-content mb-6">👤 User Management</h2>
                <div class="space-y-4 text-base-content/80">
                    <div>
                        <h3 class="font-bold text-lg mb-2">Creating an Account</h3>
                        <p>Visit the registration page and provide your email, name, and password. You'll receive a confirmation email to verify your account.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Updating Your Profile</h3>
                        <p>Navigate to your profile settings to update your bio, profile picture, email, and password.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Viewing Other Profiles</h3>
                        <p>Click on any username to view their public profile, see their ideas, and learn about them.</p>
                    </div>
                </div>
            </div>

            <!-- Managing Ideas -->
            <div id="ideas" class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200 scroll-mt-20">
                <h2 class="text-3xl font-bold text-base-content mb-6">💡 Managing Ideas</h2>
                <div class="space-y-4 text-base-content/80">
                    <div>
                        <h3 class="font-bold text-lg mb-2">Creating an Idea</h3>
                        <p>Click "Create Idea" from your dashboard. Fill in the title, description, and add up to 5 steps for implementation. You can also upload a cover image.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Editing Ideas</h3>
                        <p>Only the idea creator can edit. Click the edit button on your idea to modify details or update the implementation steps.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Idea Status</h3>
                        <p>Mark ideas as "Not Started", "In Progress", or "Completed" to track their development stage.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Liking & Bookmarking</h3>
                        <p>Like ideas you find interesting and bookmark them for later reference.</p>
                    </div>
                </div>
            </div>

            <!-- Teams & Collaboration -->
            <div id="teams" class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200 scroll-mt-20">
                <h2 class="text-3xl font-bold text-base-content mb-6">👥 Teams & Collaboration</h2>
                <div class="space-y-4 text-base-content/80">
                    <div>
                        <h3 class="font-bold text-lg mb-2">Creating a Team</h3>
                        <p>Go to the Teams section and click "Create Team". Give your team a name and description, then invite members.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Adding Members</h3>
                        <p>Team owners can add members by email. Members receive an invitation and can join the team.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Sharing Ideas with Teams</h3>
                        <p>Share your ideas with specific teams so that team members can view, comment, and collaborate on them.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Team Roles</h3>
                        <p>Teams have two roles: Owner (full control) and Member (can view and comment on shared ideas).</p>
                    </div>
                </div>
            </div>

            <!-- Comments & Feedback -->
            <div id="comments" class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-base-200 scroll-mt-20">
                <h2 class="text-3xl font-bold text-base-content mb-6">💬 Comments & Feedback</h2>
                <div class="space-y-4 text-base-content/80">
                    <div>
                        <h3 class="font-bold text-lg mb-2">Leaving Comments</h3>
                        <p>Click on any idea to view details and leave constructive comments. Be respectful and helpful.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Community Guidelines</h3>
                        <p>All comments must follow our community guidelines. Spam and abuse will result in account suspension.</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2">Notifications</h3>
                        <p>You'll be notified when someone comments on your ideas or mentions you in a comment.</p>
                    </div>
                </div>
            </div>

            <!-- API Documentation (Coming Soon) -->
            <div class="bg-gradient-to-r from-accent/10 to-warning/10 rounded-2xl p-8 border border-accent/20">
                <h2 class="text-2xl font-bold mb-2">🔧 API Documentation</h2>
                <p class="text-base-content/70 mb-4">Our API is coming soon! This will allow you to integrate IdeaBoard with your own applications.</p>
                <button class="btn btn-outline btn-sm">Subscribe to Updates</button>
            </div>
        </div>
    </div>
</x-layout>
