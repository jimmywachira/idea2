<footer class="bg-base-200 pt-6 pb-6" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <!-- Brand -->
            <div class="space-y-8 xl:col-span-1">
                <a href="/" class="text-2xl font-bold text-primary tracking-tight flex items-center gap-2">
                    <ion-icon name="bulb-outline" class="w-8 h-8"></ion-icon>
                    <span>Ideas</span>
                </a>
                <p class="text-sm opacity-80 leading-relaxed max-w-xs">
                    A community-driven platform to share, discuss, and refine innovative ideas. Turn your thoughts into reality.
                </p>
                <div class="flex space-x-5">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">Twitter</span>
                        <ion-icon name="logo-twitter" class="h-6 w-6"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">GitHub</span>
                        <ion-icon name="logo-github" class="h-6 w-6"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <span class="sr-only">YouTube</span>
                        <ion-icon name="logo-youtube" class="h-6 w-6"></ion-icon>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div class="mt-10 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-primary tracking-wider uppercase">Platform</h3>
                        <ul class="mt-4 space-y-3">
                            <li><a href="/ideas" class="text-base text-gray-300 hover:text-white transition-colors">All Ideas</a></li>
                            <li><a href="/ideas/create" class="text-base text-gray-300 hover:text-white transition-colors">Submit Idea</a></li>
                            @guest
                            <li><a href="/login" class="text-base text-gray-300 hover:text-white transition-colors">Login</a></li>
                            <li><a href="/register" class="text-base text-gray-300 hover:text-white transition-colors">Register</a></li>
                            @endguest
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold text-primary tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-3">
                            <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors">Guidelines</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Subscribe -->
                <div class="mt-10 md:mt-0">
                    <h3 class="text-sm font-semibold text-primary tracking-wider uppercase">Newsletter</h3>
                    <p class="mt-4 text-sm text-gray-300">Get the latest inspiring ideas delivered to your inbox.</p>
                    <form class="mt-4 sm:flex sm:max-w-md">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input type="email" name="email-address" id="email-address" autocomplete="email" required class="input input-bordered w-full focus:ring-primary focus:border-primary" placeholder="Enter your email">
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <button type="submit" class="btn btn-primary w-full">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="mt-12 border-t border-primary pt-8 text-center">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Ideas Project. All rights reserved.</p>
        </div>
    </div>
</footer>
