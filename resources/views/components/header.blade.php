 <!-- Navigation -->    
<header class="sticky w-full backdrop-blur-md">
    <nav class="p-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-blue-800"><span class="text-blue-400">-</span> Blog </a>
        <div class=" gap-1 font-bold">
            <a wire:navigate href="/" class="transition px-4 rounded-full rounded-r py-2 hover:text-2xl border-2 border-black hover:text-blue-600 {{ request()->is('/') ? 'text-blue-600 text-2xl border-blue-600' : '' }}">Home</a>
            <a wire:navigate href="/contact" class="transition px-4 py-2 hover:text-2xl border-2 border-black {{ request()->is('contact') ? 'text-blue-600 text-2xl border-blue-600' : '' }}">About Us</a>

            @auth
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'text-blue-600 text-2xl border-blue-600 border-2 ' : '' }}  px-4 py-2 border-2 border-black hover:text-2xl rounded-full rounded-l">AdminDashboard</a>
            @endauth
        </div>

        <div class="">
            @guest
                <a wire:navigate href="/login" class="transition
                px-4 py-2 hover:text-blue-600 {{ request()->is('login') ? 'text-blue-600 text-2xl border-blue-600' : '' }}">Login</a>
            @endguest

            @auth
                <a class="transition px-4 py-2 hover:text-blue-600 " href='/logout'>Logout</a>
            @endauth
        </div>
    </nav>
</header> 