<div class="navbar bg-base-200 p-2 capitalize">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
      </div>
      <ul
        tabindex="-1"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a href="/ideas" class="text-2xl{{ request()->routeIs('ideas.index') ? ' font-bold text-primary tracking-tight' : 'font-semibold opacity-100' }}">home</a></li>
        
        <li><a class="text-2xl {{ request()->routeIs('about') ? ' font-bold text-primary tracking-tight' : 'font-semibold opacity-100' }}" href="/about">about</a></li>
        
        @can('view-admin')
        <li><a href="/admin">admin</a></li>
        @endcan
        
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">ideas</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a href="/ideas" class="text-2xl {{ request()->routeIs('ideas.index') ? ' font-bold text-primary tracking-tight' : 'font-semibold opacity-100' }}">home</a></li>
      <li><a href="/about" class="text-2xl {{ request()->routeIs('about') ? ' font-bold text-primary tracking-tight' : 'font-semibold opacity-100' }}" href="/about">about</a></li>
    </ul>
  </div>

  <div class="navbar-end space-x-2">

  @guest
    <a href="/register" class="btn btn-primary">Register</a>
    <a href="/login" class="btn btn-secondary">Log In</a>
  @else
    <form action="/logout" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-ghost">Log Out</button>
    </form>
  @endguest

  </div>
</div>