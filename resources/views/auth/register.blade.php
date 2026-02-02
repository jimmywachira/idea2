<x-layout>
    <div class="text-primary min-h-screen bg-gradient-to-br from-secondary/10 via-base-100 to-primary/10 flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-5xl">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- Left Side - Info Card -->
                <div class="hidden lg:block">
                    <div class="bg-gradient-to-br from-secondary to-secondary/80 rounded-2xl shadow-2xl p-8 text-black space-y-6">
                        <!-- Logo/Branding -->
                        <div class="space-y-2">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 rounded-lg mb-2">
                                <ion-icon name="bulb" class="text-3xl text-black"></ion-icon>
                            </div>
                            <h2 class="text-3xl font-bold">IdeaBoard</h2>
                            <p class=" text-sm">Collaborative Innovation Platform</p>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-4 pt-6">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg text-black"></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Share Your Ideas</h3>
                                    <p class=" text-sm">Post and refine your innovative concepts</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg text-black"></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Build Teams</h3>
                                    <p class=" text-sm">Collaborate with like-minded innovators</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg text-black"></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Get Feedback</h3>
                                    <p class=" text-sm">Receive constructive comments and insights</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                                    <ion-icon name="checkmark" class="text-lg text-black"></ion-icon>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base">Track Progress</h3>
                                    <p class=" text-sm">Monitor ideas from concept to completion</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 space-y-3 border border-white/20 pt-6 mt-6">
                            <div class="flex justify-between items-center">
                                <span class="text-black/80">Active Users</span>
                                <span class="text-2xl font-bold">1000+</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-black/80">Teams Created</span>
                                <span class="text-2xl font-bold">500+</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-black/80">Ideas Shared</span>
                                <span class="text-2xl font-bold">5000+</span>
                            </div>
                        </div>

                        <!-- Quote -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 italic">
                            <p class="text-black/90">"Great ideas start conversations, conversations lead to innovations, and innovations change the world."</p>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Registration Form -->
                <div>
                    <div class="bg-base-100 rounded-2xl shadow-2xl overflow-hidden border border-base-200">
                        <!-- Header Section -->
                        <div class="bg-gradient-to-r from-secondary to-secondary/80 px-8 py-8 text-center">
                            <h1 class="text-3xl font-bold text-black">Create Account</h1>
                            <p class="text-black/80 mt-2 text-sm">Join our community today</p>
                        </div>

                        <!-- Form Section -->
                        <form action="/register" method="POST" class="px-8 py-8 space-y-4">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-base-content">Full Name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="input input-bordered w-full focus:input-secondary transition-colors"
                                    placeholder="John Doe" 
                                    value="{{ old('name') }}" 
                                    required 
                                />
                                @error('name')
                                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-base-content">Email Address</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="input input-bordered w-full focus:input-secondary transition-colors"
                                    placeholder="you@example.com" 
                                    value="{{ old('email') }}" 
                                    required 
                                />
                                @error('email')
                                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-base-content">Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    class="input input-bordered w-full focus:input-secondary transition-colors"
                                    placeholder="••••••••" 
                                    required 
                                />
                                @error('password')
                                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-base-content/60 mt-1">Minimum 8 characters with letters and numbers</p>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start space-x-3 pt-2">
                                <input 
                                    type="checkbox" 
                                    id="terms" 
                                    name="terms" 
                                    class="checkbox checkbox-sm checkbox-secondary mt-1" 
                                    required 
                                />
                                <label for="terms" class="text-sm text-base-content/70 leading-relaxed">
                                    I agree to the 
                                    <a href="#" class="text-secondary hover:text-secondary/80 font-semibold">Terms of Service</a>
                                    and
                                    <a href="#" class="text-secondary hover:text-secondary/80 font-semibold">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="btn btn-secondary w-full py-3 text-base font-semibold mt-6 hover:shadow-lg transition-all"
                            >
                                <ion-icon name="person-add" class="text-xl"></ion-icon>
                                Create Account
                            </button>
                        </form>

                        <!-- Footer Section -->
                        <div class="border-t border-base-200 px-8 py-4 bg-base-50 text-center">
                            <p class="text-sm text-base-content/70">
                                Already have an account?
                                <a href="/login" class="font-semibold text-secondary hover:text-secondary/80">
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Mobile Info Banner -->
            <div class="lg:hidden mt-8 bg-gradient-to-r from-secondary to-secondary/80 rounded-xl p-6 text-black text-center">
                <h2 class="text-2xl font-bold mb-2">Join 1000+ Innovators</h2>
                <p class="text-black/80">Share ideas, build teams, and collaborate with creators worldwide</p>
            </div>
        </div>
    </div>
</x-layout>