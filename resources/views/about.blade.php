<x-layout title="About Us">
    <!-- Hero Section -->
    <div class="hero min-h-[400px] text-white bg-base-100 rounded-box mb-12 mt-4">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold text-primary">Our Story</h1>
                <p class="py-6 text-lg opacity-80">
                    We are building a community where ideas flourish. From a simple spark to a fully realized project, we provide the platform to share, discuss, and grow.
                </p>
                <a href="#contact" class="btn btn-primary">Get in Touch</a>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4">
        
        <!-- Mission & Values -->
        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body items-center text-center">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        <ion-icon name="bulb-outline" class="w-8 h-8"></ion-icon>
                    </div>
                    <h2 class="card-title">Innovation</h2>
                    <p>We believe in the power of new ideas to change the world. Every great project starts with a single thought.</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body items-center text-center">
                    <div class="w-16 h-16 rounded-full bg-secondary/10 flex items-center justify-center mb-4 text-secondary">
                        <ion-icon name="people-outline" class="w-8 h-8"></ion-icon>
                    </div>
                    <h2 class="card-title">Community</h2>
                    <p>Collaboration is at our core. We foster a supportive environment where developers and creators help each other.</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body items-center text-center">
                    <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mb-4 text-accent">
                        <ion-icon name="rocket-outline" class="w-8 h-8"></ion-icon>
                    </div>
                    <h2 class="card-title">Growth</h2>
                    <p>We provide the tools and feedback loops necessary to take your projects to the next level.</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats shadow w-full mb-20 bg-base-100 border border-base-300 overflow-hidden">
            <div class="stat place-items-center">
                <div class="stat-figure text-primary">
                    <ion-icon name="heart" class="w-8 h-8"></ion-icon>
                </div>
                <div class="stat-title">Total Likes</div>
                <div class="stat-value text-primary">25.6K</div>
                <div class="stat-desc">From 21st Jan to 1st Feb</div>
            </div>
            
            <div class="stat place-items-center">
                <div class="stat-figure text-secondary">
                    <ion-icon name="flash" class="w-8 h-8"></ion-icon>
                </div>
                <div class="stat-title">Ideas Shared</div>
                <div class="stat-value text-secondary">2,600</div>
                <div class="stat-desc">↗︎ 22% (30 days)</div>
            </div>
            
            <div class="stat place-items-center">
                <div class="stat-figure text-accent">
                    <ion-icon name="people" class="w-8 h-8"></ion-icon>
                </div>
                <div class="stat-title">New Users</div>
                <div class="stat-value text-accent">1,200</div>
                <div class="stat-desc">↘︎ 90 (14 days)</div>
            </div>
        </div>

        <!-- Contact Section -->
        <div id="contact" class="grid md:grid-cols-2 gap-12 mb-20 items-start">
            <div>
                <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
                <p class="text-lg opacity-80 mb-8">
                    Have a question, suggestion, or just want to say hello? We'd love to hear from you. Fill out the form and we'll get back to you as soon as possible.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-base-200 flex items-center justify-center text-primary">
                            <ion-icon name="location" class="w-5 h-5"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold">Our Office</h3>
                            <p class="opacity-70">123 Kikambala Drive, Nairobi</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-base-200 flex items-center justify-center text-primary">
                            <ion-icon name="mail" class="w-5 h-5"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold">Email Us</h3>
                            <p class="opacity-70">hello@webdevs.com</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-base-200 flex items-center justify-center text-primary">
                            <ion-icon name="call" class="w-5 h-5"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold">Call Us</h3>
                            <p class="opacity-70">+254 (701) 163-149</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Livewire Form -->
            <div class="card bg-base-100 shadow-2xl">
                <div class="card-body">
                    @if (session('success'))
                        <div role="alert" class="alert alert-success mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Thank you for your message! We will get back to you soon.</span>
                        </div>
                    @endif

                    <form wire:submit="submit" class="space-y-4">
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" id="name" wire:model="name" placeholder="Enter your full name" class="input input-bordered w-full @error('name') input-error @enderror" />
                            @error('name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="email">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" id="email" wire:model="email" placeholder="your.email@example.com" class="input input-bordered w-full @error('email') input-error @enderror" />
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="subject">
                                <span class="label-text">Subject</span>
                            </label>
                            <input type="text" id="subject" wire:model="subject" placeholder="What is this about?" class="input input-bordered w-full @error('subject') input-error @enderror" />
                            @error('subject') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label" for="message">
                                <span class="label-text">Message</span>
                            </label>
                            <textarea id="message" wire:model="message" class="textarea textarea-bordered h-32 @error('message') textarea-error @enderror" placeholder="Tell us what's on your mind..."></textarea>
                            @error('message') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>Send Message</span>
                                <span wire:loading class="loading loading-spinner"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>