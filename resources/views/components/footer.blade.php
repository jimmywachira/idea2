<footer class="bg-base-100 border-t border-base-200 mt-20" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Brand Section -->
            <div class="lg:col-span-1">
                <a href="/" class="flex items-center gap-2 mb-4 group">
                    <div class="p-2 bg-primary/10 rounded-lg group-hover:bg-primary/20 transition-colors">
                        <ion-icon name="bulb" class="text-2xl text-primary"></ion-icon>
                    </div>
                    <span class="text-xl font-bold text-base-content">Ideas</span>
                </a>
                <p class="text-sm text-base-content/60 leading-relaxed mb-6">
                    Transform your thoughts into action. A collaborative platform for innovators and creators.
                </p>
                
                <!-- Social Links -->
                <div class="flex gap-3">
                    <a href="#" class="btn btn-ghost btn-circle btn-sm hover:bg-primary/10 hover:text-primary transition-all">
                        <ion-icon name="logo-twitter" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="btn btn-ghost btn-circle btn-sm hover:bg-primary/10 hover:text-primary transition-all">
                        <ion-icon name="logo-github" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="btn btn-ghost btn-circle btn-sm hover:bg-primary/10 hover:text-primary transition-all">
                        <ion-icon name="logo-linkedin" class="text-xl"></ion-icon>
                    </a>
                    <a href="#" class="btn btn-ghost btn-circle btn-sm hover:bg-primary/10 hover:text-primary transition-all">
                        <ion-icon name="logo-youtube" class="text-xl"></ion-icon>
                    </a>
                </div>
            </div>

            <!-- Platform Links -->
            <div>
                <h3 class="text-sm font-bold text-base-content uppercase tracking-wider mb-4 flex items-center gap-2">
                    <ion-icon name="apps" class="text-primary"></ion-icon>
                    Platform
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('ideas.index') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Browse Ideas
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Trending
                        </a>
                    </li>
                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Sign In
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Get Started
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('profiles.show', auth()->user()) }}" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            My Profile
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>

            <!-- Resources Links -->
            <div>
                <h3 class="text-sm font-bold text-base-content uppercase tracking-wider mb-4 flex items-center gap-2">
                    <ion-icon name="document-text" class="text-primary"></ion-icon>
                    Resources
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Documentation
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Community Guidelines
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors flex items-center gap-2 group">
                            <ion-icon name="chevron-forward" class="text-xs group-hover:translate-x-1 transition-transform"></ion-icon>
                            Terms of Service
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter Section -->
            <div>
                <h3 class="text-sm font-bold text-base-content uppercase tracking-wider mb-4 flex items-center gap-2">
                    <ion-icon name="mail" class="text-primary"></ion-icon>
                    Stay Updated
                </h3>
                <p class="text-sm text-base-content/60 mb-4 leading-relaxed">
                    Get weekly inspiration and trending ideas delivered to your inbox.
                </p>
                <form class="space-y-3" x-data="{ isSubmitting: false }" @submit="isSubmitting = true">
                    <div class="form-control">
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="your@email.com" 
                            class="input input-bordered input-sm w-full focus:input-primary" 
                            required>
                    </div>
                    <button 
                        type="submit" 
                        class="btn btn-primary btn-sm w-full gap-2"
                        :disabled="isSubmitting">
                        <ion-icon name="send" class="text-base"></ion-icon>
                        <span x-text="isSubmitting ? 'Subscribing...' : 'Subscribe'"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-base-200">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-base-content/60 text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="font-semibold text-primary">Ideas Project</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors">
                        Status
                    </a>
                    <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors">
                        API
                    </a>
                    <a href="#" class="text-sm text-base-content/60 hover:text-primary transition-colors">
                        Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
