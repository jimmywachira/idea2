<x-layout title="About Us" 
description="We are building a community where ideas flourish. Join us to share, discuss, and grow your projects.">
        <!-- Structured Data for SEO -->
        @verbatim
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Idea Board",
            "url": "{{ url('/') }}",
            "logo": "{{ url('/images/logo.png') }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+254-701-163-149",
                "contactType": "Customer service"
            },
            "sameAs": [
                "https://twitter.com/webdevs",
                "https://facebook.com/webdevs"
            ]
        }
        </script>
        @endverbatim

    <div class="space-y-16">
        
        <!-- Hero Section -->
        <section class="hero bg-base-100 rounded-3xl shadow-sm border border-base-200 py-16">
            <div class="hero-content text-center">
                <div class="max-w-2xl">
                    <h1 class="text-5xl font-extrabold tracking-tight text-base-content mb-6">
                        We empower <span class="text-primary">creators</span> to build the future.
                    </h1>
                    <p class="text-xl text-base-content/70 leading-relaxed mb-8">
                        From a simple spark to a fully realized project, we provide the platform to share, discuss, and grow your ideas into reality.
                    </p>
                    <a href="#contact" class="btn btn-primary px-8 rounded-full">Get in Touch</a>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section>
            <div class="stats stats-vertical lg:stats-horizontal shadow-lg bg-base-100 w-full border border-base-200 rounded-2xl overflow-hidden">
                <div class="stat place-items-center py-8">
                    <div class="stat-figure text-primary bg-primary/10 p-3 rounded-full mb-2">
                        <ion-icon name="heart" class="w-6 h-6"></ion-icon>
                    </div>
                    <div class="stat-title font-medium uppercase tracking-wide text-xs">Community Love</div>
                    <div class="stat-value text-primary text-4xl">25.6K</div>
                    <div class="stat-desc">Likes generated this month</div>
                </div>
                
                <div class="stat place-items-center py-8">
                    <div class="stat-figure text-secondary bg-secondary/10 p-3 rounded-full mb-2">
                        <ion-icon name="bulb" class="w-6 h-6"></ion-icon>
                    </div>
                    <div class="stat-title font-medium uppercase tracking-wide text-xs">Innovation</div>
                    <div class="stat-value text-secondary text-4xl">2,600</div>
                    <div class="stat-desc">Ideas shared to date</div>
                </div>
                
                <div class="stat place-items-center py-8">
                    <div class="stat-figure text-accent bg-accent/10 p-3 rounded-full mb-2">
                        <ion-icon name="people" class="w-6 h-6"></ion-icon>
                    </div>
                    <div class="stat-title font-medium uppercase tracking-wide text-xs">Growth</div>
                    <div class="stat-value text-accent text-4xl">1,200</div>
                    <div class="stat-desc">New creators joined</div>
                </div>
            </div>
        </section>

        <!-- Mission & Values -->
        <section>
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Our Core Values</h2>
                <p class="text-base-content/60 max-w-2xl mx-auto">The principles that guide every decision we make and every feature we build.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="card bg-base-100 shadow-md hover:shadow-xl transition-all duration-300 border border-base-200 group">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform duration-300">
                            <ion-icon name="bulb-outline" class="w-8 h-8"></ion-icon>
                        </div>
                        <h3 class="card-title text-xl mb-3">Innovation</h3>
                        <p class="text-base-content/70 leading-relaxed">We believe in the power of new ideas to change the world. Every great project starts with a single thought.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-md hover:shadow-xl transition-all duration-300 border border-base-200 group">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-2xl bg-secondary/10 flex items-center justify-center mb-6 text-secondary group-hover:scale-110 transition-transform duration-300">
                            <ion-icon name="people-outline" class="w-8 h-8"></ion-icon>
                        </div>
                        <h3 class="card-title text-xl mb-3">Community</h3>
                        <p class="text-base-content/70 leading-relaxed">Collaboration is at our core. We foster a supportive environment where developers and creators help each other.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-md hover:shadow-xl transition-all duration-300 border border-base-200 group">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 text-accent group-hover:scale-110 transition-transform duration-300">
                            <ion-icon name="rocket-outline" class="w-8 h-8"></ion-icon>
                        </div>
                        <h3 class="card-title text-xl mb-3">Growth</h3>
                        <p class="text-base-content/70 leading-relaxed">We provide the tools and feedback loops necessary to take your projects to the next level.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="grid md:grid-cols-2 gap-12 items-start">
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold mb-4">Get in Touch</h2>
                    <p class="text-lg text-base-content/70">
                        Have a question, suggestion, or just want to say hello? We'd love to hear from you.
                    </p>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-base-100 border border-base-200 shadow-sm">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <ion-icon name="location" class="w-6 h-6"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Visit Us</h3>
                            <p class="text-base-content/70">123 Kikambala Drive<br>Nairobi, Kenya</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-base-100 border border-base-200 shadow-sm">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <ion-icon name="mail" class="w-6 h-6"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Email Us</h3>
                            <a href="mailto:hello@webdevs.com" class="text-base-content/70 hover:text-primary transition-colors">hello@webdevs.com</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-base-100 border border-base-200 shadow-sm">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <ion-icon name="call" class="w-6 h-6"></ion-icon>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Call Us</h3>
                            <a href="tel:+254701163149" class="text-base-content/70 hover:text-primary transition-colors">+254 (701) 163-149</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body p-8">
                    <h3 class="card-title mb-6">Send us a message</h3>
                    
                    @if (session('success'))
                        <div role="alert" class="alert alert-success mb-6">
                            <ion-icon name="checkmark-circle" class="text-xl"></ion-icon>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form wire:submit="submit" class="space-y-5">
                        <div class="form-control">
                            <label class="label font-medium" for="name">
                                <span class="label-text">Full Name</span>
                            </label>
                            <input type="text" id="name" wire:model="name" placeholder="John Doe" class="input input-bordered w-full focus:input-primary @error('name') input-error @enderror" />
                            @error('name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label font-medium" for="email">
                                <span class="label-text">Email Address</span>
                            </label>
                            <input type="email" id="email" wire:model="email" placeholder="john@example.com" class="input input-bordered w-full focus:input-primary @error('email') input-error @enderror" />
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label font-medium" for="subject">
                                <span class="label-text">Subject</span>
                            </label>
                            <input type="text" id="subject" wire:model="subject" placeholder="How can we help?" class="input input-bordered w-full focus:input-primary @error('subject') input-error @enderror" />
                            @error('subject') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label font-medium" for="message">
                                <span class="label-text">Message</span>
                            </label>
                            <textarea id="message" wire:model="message" class="textarea textarea-bordered h-32 focus:textarea-primary @error('message') textarea-error @enderror" placeholder="Tell us more..."></textarea>
                            @error('message') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-control mt-4">
                            <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled">
                                <span wire:loading.remove>Send Message</span>
                                <span wire:loading class="loading loading-spinner loading-sm"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-layout>