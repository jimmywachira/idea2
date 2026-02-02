<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-primary/10 via-base-100 to-secondary/10 flex items-center justify-center py-8 px-4 text-primary">
        <div class="w-full max-w-5xl">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- Left Side - Info Card -->
                <div class="hidden lg:block">
                    <div class="bg-gradient-to-br from-primary to-primary/80 rounded-2xl shadow-2xl p-8  space-y-6">
                        <!-- Logo/Branding -->
                        <div class="space-y-2">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 rounded-lg mb-2">
                                <ion-icon name="bulb" class="text-3xl "></ion-icon>
                            </div>
                            <h2 class="text-3xl font-bold">IdeaBoard</h2>
                            <p class="/80 text-sm">Collaborative Innovation Platform</p>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-4 pt-6">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg "></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Secure Access</h3>
                                    <p class="/70 text-sm">Protected login with enterprise-grade security</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg "></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Access Anywhere</h3>
                                    <p class="/70 text-sm">Use on desktop, tablet, or mobile device</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg "></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Instant Sync</h3>
                                    <p class="/70 text-sm">Your ideas and teams sync in real-time</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg "></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">24/7 Support</h3>
                                    <p class="/70 text-sm">Get help anytime you need it</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 space-y-3 border border-white/20 pt-6 mt-6">
                            <div class="flex justify-between items-center">
                                <span class="/80">Active Users</span>
                                <span class="text-2xl font-bold">1000+</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="/80">Teams Created</span>
                                <span class="text-2xl font-bold">500+</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="/80">Ideas Shared</span>
                                <span class="text-2xl font-bold">5000+</span>
                            </div>
                        </div>

                        <!-- Quote -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 italic">
                            <p class="/90">"Your ideas matter. Let's build something amazing together."</p>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div>
                    <div class="bg-base-100 rounded-2xl shadow-2xl overflow-hidden border border-base-200">
                        <!-- Header Section -->
                        <div class="bg-gradient-to-r from-primary to-primary/80 px-8 py-8 text-center">
                            <h1 class="text-3xl font-bold ">Welcome Back</h1>
                            <p class="/80 mt-2 text-sm">Sign in to your account</p>
                        </div>

                        <!-- Form Section -->
                        <form action="/login" method="POST" class="px-8 py-8 space-y-4">
                            @csrf
                            
                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-base-content">Email Address</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="input input-bordered w-full focus:input-primary transition-colors"
                                    placeholder="you@example.com" 
                                    value="{{ old('email') }}" 
                                    required 
                                />
                                <x-form.error name="email" />
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-base-content">Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    class="input input-bordered w-full focus:input-primary transition-colors"
                                    placeholder="••••••••" 
                                    required 
                                />
                                <x-form.error name="password" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between pt-2">
                                <label class="label cursor-pointer p-0">
                                    <input type="checkbox" name="remember" class="checkbox checkbox-sm" />
                                    <span class="label-text ml-2 text-sm">Remember me</span>
                                </label>
                                <a href="#" class="text-sm text-primary hover:text-primary/80 font-semibold">Forgot password?</a>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="btn btn-primary w-full py-3 text-base font-semibold mt-6 hover:shadow-lg transition-all"
                            >
                                <ion-icon name="log-in" class="text-xl"></ion-icon>
                                Sign In
                            </button>
                        </form>

                        <!-- Footer Section -->
                        <div class="border-t border-base-200 px-8 py-4 bg-base-50 text-center">
                            <p class="text-sm text-base-content/70">
                                Don't have an account?
                                <a href="/register" class="font-semibold text-primary hover:text-primary/80">
                                    Create one
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Mobile Info Banner -->
            <div class="lg:hidden mt-8 bg-gradient-to-r from-primary to-primary/80 rounded-xl p-6  text-center">
                <h2 class="text-2xl font-bold mb-2">Secure & Reliable</h2>
                <p class="/80">Access your ideas and collaborate with your team securely, anytime, anywhere</p>
            </div>
        </div>
    </div>
</x-layout>