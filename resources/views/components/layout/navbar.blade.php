<div class="navbar bg-base-200 p-2" x-data="{ theme: localStorage.getItem('theme') || 'coffee' }" x-init="$watch('theme', val => { document.documentElement.setAttribute('data-theme', val); localStorage.setItem('theme', val); })">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
      </div>
      <ul
        tabindex="-1"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a href="/" class="text-2xl{{ request()->routeIs('home') ? ' font-bold text-primary tracking-tight' : '' }}">home</a></li>
        
        <li><a class="text-2xl {{ request()->routeIs('about') ? ' font-bold text-primary tracking-tight' : '' }}" href="/about">about</a></li>
        
        @auth
        <li><a href="{{ route('profiles.show', auth()->user()) }}" class="text-2xl">profile</a></li>
        @endauth
        
        @if(auth()->check() && auth()->user()->isAdmin())
        <li><a href="{{ route('admin.dashboard') }}" class="text-2xl text-error">admin</a></li>
        @endif
        
      </ul>
    </div>

    <a class="btn btn-ghost text-xl">
      <ion-icon size="large" class="text-primary" name="logo-ionic"></ion-icon>
    </a>

  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a href="/" class="text-2xl {{ request()->routeIs('home') ? ' font-bold text-primary tracking-tight' : '' }}">home</a></li>
      <li><a href="/about" class="text-2xl {{ request()->routeIs('about') ? ' font-bold text-primary tracking-tight' : '' }}">about</a></li>
      @if(auth()->check() && auth()->user()->isAdmin())
      <li><a href="{{ route('admin.dashboard') }}" class="text-2xl text-error">admin</a></li>
      @endif
    </ul>
  </div>

  <div class="navbar-end space-x-2">
    <!-- Theme Toggle Button -->
    <button 
      @click="theme = theme === 'coffee' ? 'light' : 'coffee'"
      type="button"
      class="btn btn-ghost btn-circle"
      title="Toggle dark mode">
      <ion-icon :name="theme === 'coffee' ? 'moon' : 'sunny'" size="large"></ion-icon>
    </button>

  @guest
    <a href="/register" class="btn btn-primary">Register</a>
    <a href="/login" class="btn btn-secondary">Log In</a>
  @else
    <a href="{{ route('profiles.show', auth()->user()) }}" class="btn btn-ghost hidden lg:flex gap-2">
      <ion-icon name="person-circle" size="large"></ion-icon>
      <span class="hidden xl:inline text-sm">{{ auth()->user()->name }}</span>
    </a>
    <form action="/logout" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-ghost">Log Out</button>
    </form>
  @endguest

  </div>
</div>