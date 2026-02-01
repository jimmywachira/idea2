<div class="min-h-screen bg-gradient-to-br from-base-100 to-base-200">
    <!-- Sidebar Navigation -->
    <div class="fixed left-0 top-0 w-64 h-screen bg-base-100 border-r border-base-300 shadow-lg z-40 flex flex-col">
        <!-- Logo/Header -->
        <div class="p-6 border-b border-base-300">
            <h1 class="text-2xl font-bold text-primary flex items-center gap-2">
                <ion-icon name="bulb" class="text-3xl"></ion-icon>
                IdeaBoard
            </h1>
            <p class="text-xs text-base-content/60 mt-1">Pro Dashboard</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-2">
            <!-- Ideas Section -->
            <button 
                wire:click="setActiveSection('ideas')"
                class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center gap-3 {{ $activeSection === 'ideas' ? 'bg-primary text-white shadow-lg' : 'hover:bg-base-200 text-base-content' }}">
                <ion-icon name="bulb" class="text-xl"></ion-icon>
                <span class="font-medium">My Ideas</span>
                @if($ideas->count() > 0)
                    <span class="ml-auto badge {{ $activeSection === 'ideas' ? 'badge-white' : 'badge-primary' }} text-xs">{{ $ideas->count() }}</span>
                @endif
            </button>

            <!-- Teams Section -->
            <button 
                wire:click="setActiveSection('teams')"
                class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center gap-3 {{ $activeSection === 'teams' ? 'bg-primary text-white shadow-lg' : 'hover:bg-base-200 text-base-content' }}">
                <ion-icon name="people" class="text-xl"></ion-icon>
                <span class="font-medium">Teams</span>
                @if($teams->count() > 0)
                    <span class="ml-auto badge {{ $activeSection === 'teams' ? 'badge-white' : 'badge-primary' }} text-xs">{{ $teams->count() }}</span>
                @endif
            </button>

            <!-- Team Ideas Section -->
            @if($teams->count() > 0)
                <button 
                    wire:click="setActiveSection('team-ideas')"
                    class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center gap-3 {{ $activeSection === 'team-ideas' ? 'bg-primary text-white shadow-lg' : 'hover:bg-base-200 text-base-content' }}">
                    <ion-icon name="share-social" class="text-xl"></ion-icon>
                    <span class="font-medium">Shared Ideas</span>
                    @if($teamIdeas->count() > 0)
                        <span class="ml-auto badge {{ $activeSection === 'team-ideas' ? 'badge-white' : 'badge-primary' }} text-xs">{{ $teamIdeas->count() }}</span>
                    @endif
                </button>
            @endif

            <!-- Profile Section -->
            <button 
                wire:click="setActiveSection('profile')"
                class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center gap-3 {{ $activeSection === 'profile' ? 'bg-primary text-white shadow-lg' : 'hover:bg-base-200 text-base-content' }}">
                <ion-icon name="person" class="text-xl"></ion-icon>
                <span class="font-medium">Profile</span>
            </button>

            <!-- Admin Section (if admin) -->
            @if($user->isAdmin())
                <div class="divider my-2"></div>
                <button 
                    wire:click="setActiveSection('admin')"
                    class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 flex items-center gap-3 {{ $activeSection === 'admin' ? 'bg-error text-white shadow-lg' : 'hover:bg-base-200 text-base-content' }}">
                    <ion-icon name="settings" class="text-xl"></ion-icon>
                    <span class="font-medium">Admin</span>
                </button>
            @endif
        </nav>

        <!-- User Footer -->
        <div class="p-4 border-t border-base-300 space-y-3">
            <div class="flex items-center gap-3 p-3 bg-base-200 rounded-lg">
                <div class="avatar placeholder">
                    <div class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-sm truncate">{{ $user->name }}</p>
                    <p class="text-xs text-base-content/60 truncate">{{ $user->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full btn btn-ghost btn-sm gap-2">
                    <ion-icon name="log-out"></ion-icon>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="ml-64 min-h-screen">
        <div class="p-6 sm:p-8 max-w-7xl mx-auto">
            <!-- My Ideas Section -->
            @if($activeSection === 'ideas')
                <div class="animate-fade-in">
                    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">My Ideas</h1>
                            <p class="text-base sm:text-lg text-base-content/60">Manage and track your brilliant ideas</p>
                        </div>
                        <button 
                            x-data
                            @click="$dispatch('open-idea-form', { idea: null })"
                            class="btn btn-primary gap-2 shadow-lg shadow-primary/20">
                            <ion-icon name="add-circle" class="text-xl"></ion-icon>
                            <span>New Idea</span>
                        </button>
                    </div>

                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">
                        <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                            <div class="stat p-4 sm:p-6">
                                <div class="stat-figure text-primary bg-primary/10 p-2 sm:p-3 rounded-full">
                                    <ion-icon name="bulb" class="text-2xl sm:text-3xl"></ion-icon>
                                </div>
                                <div class="stat-title font-medium text-xs sm:text-sm">Total Ideas</div>
                                <div class="stat-value text-primary text-2xl sm:text-4xl">{{ $ideas->count() }}</div>
                            </div>
                        </div>
                        
                        <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                            <div class="stat p-4 sm:p-6">
                                <div class="stat-figure text-warning bg-warning/10 p-2 sm:p-3 rounded-full">
                                    <ion-icon name="time" class="text-2xl sm:text-3xl"></ion-icon>
                                </div>
                                <div class="stat-title font-medium text-xs sm:text-sm">In Progress</div>
                                <div class="stat-value text-warning text-2xl sm:text-4xl">{{ $ideas->where('status', 'in_progress')->count() }}</div>
                            </div>
                        </div>

                        <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                            <div class="stat p-4 sm:p-6">
                                <div class="stat-figure text-success bg-success/10 p-2 sm:p-3 rounded-full">
                                    <ion-icon name="checkmark-circle" class="text-2xl sm:text-3xl"></ion-icon>
                                </div>
                                <div class="stat-title font-medium text-xs sm:text-sm">Completed</div>
                                <div class="stat-value text-success text-2xl sm:text-4xl">{{ $ideas->where('status', 'completed')->count() }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ideas Grid -->
                    <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($ideas as $idea)
                            <div class="card !p-0 group hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-base-200 bg-base-100 h-full flex flex-col relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 {{ $idea->status === 'completed' ? 'bg-success' : ($idea->status === 'in_progress' ? 'bg-warning' : 'bg-primary') }}"></div>

                                <div class="p-6 flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-2 text-xs text-base-content/60 font-medium">
                                            <ion-icon name="calendar-clear-outline" class="text-sm"></ion-icon>
                                            <span>{{ $idea->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <span class="badge {{ $idea->status === 'completed' ? 'badge-success' : ($idea->status === 'in_progress' ? 'badge-warning' : 'badge-primary') }}">
                                            {{ $idea->status->label() }}
                                        </span>
                                    </div>

                                    <div class="mb-6 flex-grow">
                                        <div class="mb-4 overflow-hidden rounded-lg">
                                            <img 
                                                src="https://picsum.photos/seed/{{ $idea->id }}/400/300" 
                                                alt="{{ $idea->title }}"
                                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                                loading="lazy">
                                        </div>

                                        <h3 class="text-xl font-bold text-base-content mb-2 leading-tight group-hover:text-primary transition-colors">
                                            <a href="{{ route('ideas.show', $idea->id) }}" class="focus:outline-none">
                                                {{ $idea->title }}
                                            </a>
                                        </h3>
                                        <p class="text-base-content/70 text-sm line-clamp-3 leading-relaxed">
                                            {{ $idea->description }}
                                        </p>
                                    </div>

                                    <div class="pt-4 border-t border-base-200 flex items-center justify-between mt-auto">
                                        <div class="flex items-center gap-3 text-base-content/50">
                                            <div class="flex items-center gap-1 text-xs font-medium" title="Likes">
                                                <ion-icon name="heart" class="{{ $idea->likes()->count() > 0 ? 'text-error' : '' }} text-sm"></ion-icon>
                                                <span>{{ $idea->likes()->count() }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 text-xs font-medium" title="Comments">
                                                <ion-icon name="chatbubble" class="{{ $idea->comments()->count() > 0 ? 'text-info' : '' }} text-sm"></ion-icon>
                                                <span>{{ $idea->comments()->count() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('ideas.edit', $idea->id) }}" class="btn btn-ghost btn-xs">
                                                <ion-icon name="pencil"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-gradient-to-br from-base-100 to-base-200/50 rounded-2xl border-2 border-dashed border-base-300">
                                <div class="bg-gradient-to-br from-primary/10 to-secondary/10 p-8 rounded-full mb-6 animate-pulse">
                                    <ion-icon name="bulb-outline" class="text-6xl text-primary"></ion-icon>
                                </div>
                                <h3 class="text-2xl sm:text-3xl font-bold mb-3">Your Idea Board Awaits!</h3>
                                <p class="text-base-content/60 max-w-md mx-auto mb-8 text-sm sm:text-base">Ready to transform your thoughts into action? Create your first idea and start building something amazing!</p>
                                <button 
                                    x-data
                                    @click="$dispatch('open-idea-form', { idea: null })"
                                    class="btn btn-primary px-8 gap-2">
                                    <ion-icon name="add-circle" class="text-xl"></ion-icon>
                                    Create First Idea
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Teams Section -->
            @if($activeSection === 'teams')
                <div class="animate-fade-in">
                    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">My Teams</h1>
                            <p class="text-base sm:text-lg text-base-content/60">Collaborate with team members on ideas</p>
                        </div>
                        <a href="{{ route('teams.create') }}" class="btn btn-primary gap-2 shadow-lg shadow-primary/20">
                            <ion-icon name="add-circle" class="text-xl"></ion-icon>
                            <span>Create Team</span>
                        </a>
                    </div>

                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($teams as $team)
                            <div class="card bg-base-100 border border-base-200 shadow-md hover:shadow-xl transition-shadow">
                                <div class="card-body">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h2 class="card-title text-lg">{{ $team->name }}</h2>
                                            <p class="text-xs text-base-content/60">
                                                @if($team->isOwner(auth()->user()))
                                                    <span class="badge badge-primary">Owner</span>
                                                @else
                                                    <span class="badge badge-secondary">Member</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    @if($team->description)
                                        <p class="text-sm text-base-content/70 mb-4 line-clamp-2">{{ $team->description }}</p>
                                    @else
                                        <p class="text-sm text-base-content/50 italic mb-4">No description</p>
                                    @endif

                                    <div class="flex gap-4 text-xs text-base-content/60 mb-4 pb-4 border-b border-base-200">
                                        <div class="flex items-center gap-1">
                                            <ion-icon name="people" class="text-sm"></ion-icon>
                                            <span>{{ $team->users()->count() }} members</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <ion-icon name="bulb" class="text-sm"></ion-icon>
                                            <span>{{ $team->ideas()->count() }} ideas</span>
                                        </div>
                                    </div>

                                    <div class="card-actions gap-2">
                                        <a href="{{ route('teams.show', $team) }}" class="btn btn-sm btn-primary flex-1">View</a>
                                        @if($team->isOwner(auth()->user()))
                                            <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-ghost">Edit</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-gradient-to-br from-base-100 to-base-200/50 rounded-2xl border-2 border-dashed border-base-300">
                                <div class="bg-gradient-to-br from-primary/10 to-secondary/10 p-8 rounded-full mb-6">
                                    <ion-icon name="people-outline" class="text-6xl text-primary"></ion-icon>
                                </div>
                                <h3 class="text-2xl font-bold mb-3">No Teams Yet</h3>
                                <p class="text-base-content/60 max-w-md mx-auto mb-8">Create your first team to start collaborating with others on ideas!</p>
                                <a href="{{ route('teams.create') }}" class="btn btn-primary gap-2">
                                    <ion-icon name="add-circle" class="text-xl"></ion-icon>
                                    Create Your First Team
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Shared Team Ideas Section -->
            @if($activeSection === 'team-ideas' && $teams->count() > 0)
                <div class="animate-fade-in">
                    <div class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">Team Ideas</h1>
                        <p class="text-base sm:text-lg text-base-content/60">Ideas shared by your team members</p>
                    </div>

                    <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($teamIdeas as $idea)
                            <div class="card !p-0 group hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-base-200 bg-base-100 h-full flex flex-col relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-secondary"></div>
                                <div class="p-6 flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-2 text-xs text-base-content/60 font-medium">
                                            <ion-icon name="calendar-clear-outline" class="text-sm"></ion-icon>
                                            <span>{{ $idea->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <span class="badge badge-secondary">Shared</span>
                                    </div>

                                    <div class="mb-4 overflow-hidden rounded-lg">
                                        <img 
                                            src="https://picsum.photos/seed/{{ $idea->id }}/400/300" 
                                            alt="{{ $idea->title }}"
                                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                            loading="lazy">
                                    </div>

                                    <h3 class="text-xl font-bold text-base-content mb-2 leading-tight group-hover:text-primary transition-colors">
                                        <a href="{{ route('ideas.show', $idea->id) }}" class="focus:outline-none">
                                            {{ $idea->title }}
                                        </a>
                                    </h3>
                                    <p class="text-base-content/70 text-sm line-clamp-2 leading-relaxed mb-4">
                                        {{ $idea->description }}
                                    </p>

                                    <div class="mt-auto pt-4 border-t border-base-200">
                                        <a href="{{ route('profiles.show', $idea->user) }}" class="flex items-center gap-2 group/author hover:bg-base-200/50 rounded-full pr-3 -ml-1 transition-colors">
                                            <div class="avatar placeholder">
                                                <div class="bg-base-300 text-base-content/70 rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold group-hover/author:bg-primary group-hover/author:text-primary-content transition-colors">
                                                    {{ substr($idea->user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-bold text-base-content/80 group-hover/author:text-primary transition-colors">{{ $idea->user->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16">
                                <ion-icon name="share-social-outline" class="text-6xl text-base-content/20 mx-auto mb-4"></ion-icon>
                                <p class="text-base-content/60">No shared ideas yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Profile Section -->
            @if($activeSection === 'profile')
                <div class="animate-fade-in max-w-3xl">
                    <div class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">My Profile</h1>
                        <p class="text-base sm:text-lg text-base-content/60">Manage your account settings</p>
                    </div>

                    <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8">
                        <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="form-control">
                                <label class="label font-medium" for="name">
                                    <span class="label-text text-sm sm:text-base">Full Name</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Your full name"
                                    class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('name') input-error @enderror" />
                                @error('name')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-control">
                                <label class="label font-medium" for="email">
                                    <span class="label-text text-sm sm:text-base">Email Address</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="your@email.com"
                                    class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('email') input-error @enderror" />
                                <span class="text-xs text-base-content/60 mt-2">Used for login and notifications</span>
                                @error('email')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div class="form-control">
                                <label class="label font-medium" for="bio">
                                    <span class="label-text text-sm sm:text-base">Bio</span>
                                </label>
                                <textarea 
                                    id="bio" 
                                    name="bio" 
                                    rows="4"
                                    placeholder="Tell us about yourself..."
                                    class="textarea textarea-bordered text-sm sm:text-base focus:textarea-primary @error('bio') textarea-error @enderror">{{ old('bio', $user->bio) }}</textarea>
                                <span class="text-xs text-base-content/60 mt-2">Max 500 characters</span>
                                @error('bio')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Avatar -->
                            <div class="form-control">
                                <label class="label font-medium" for="avatar">
                                    <span class="label-text text-sm sm:text-base">Upload New Avatar</span>
                                </label>
                                <input 
                                    type="file" 
                                    id="avatar" 
                                    name="avatar" 
                                    accept="image/*"
                                    class="file-input file-input-bordered w-full focus:file-input-primary text-sm @error('avatar') file-input-error @enderror" />
                                <span class="text-xs text-base-content/60 mt-2">Max 2MB, formats: JPG, PNG, GIF</span>
                                @error('avatar')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Section -->
                            <div class="divider">Change Password (Optional)</div>

                            <!-- Current Password -->
                            <div class="form-control">
                                <label class="label font-medium" for="current_password">
                                    <span class="label-text text-sm sm:text-base">Current Password</span>
                                </label>
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    placeholder="Enter your current password"
                                    class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('current_password') input-error @enderror" />
                                <span class="text-xs text-base-content/60 mt-2">Required if changing password</span>
                                @error('current_password')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="form-control">
                                <label class="label font-medium" for="password">
                                    <span class="label-text text-sm sm:text-base">New Password</span>
                                </label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Enter new password (min 8 characters)"
                                    class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('password') input-error @enderror" />
                                <span class="text-xs text-base-content/60 mt-2">Leave blank to keep current password</span>
                                @error('password')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-control">
                                <label class="label font-medium" for="password_confirmation">
                                    <span class="label-text text-sm sm:text-base">Confirm New Password</span>
                                </label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="Confirm new password"
                                    class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('password_confirmation') input-error @enderror" />
                                @error('password_confirmation')
                                    <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 pt-6">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Admin Section -->
            @if($activeSection === 'admin' && $user->isAdmin())
                <div class="animate-fade-in">
                    <div class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">Admin Panel</h1>
                        <p class="text-base sm:text-lg text-base-content/60">Manage users, content, and moderation</p>
                    </div>

                    <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-8">
                        <a href="{{ route('admin.users.index') }}" class="card bg-base-100 border border-base-200 shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                            <div class="card-body">
                                <h2 class="card-title text-lg flex items-center gap-2">
                                    <ion-icon name="people" class="text-2xl text-primary"></ion-icon>
                                    Users
                                </h2>
                                <p class="text-3xl font-bold text-primary">{{ \App\Models\User::count() }}</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.ideas.index') }}" class="card bg-base-100 border border-base-200 shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                            <div class="card-body">
                                <h2 class="card-title text-lg flex items-center gap-2">
                                    <ion-icon name="bulb" class="text-2xl text-warning"></ion-icon>
                                    Ideas
                                </h2>
                                <p class="text-3xl font-bold text-warning">{{ \App\Models\Idea::count() }}</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.comments.index') }}" class="card bg-base-100 border border-base-200 shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                            <div class="card-body">
                                <h2 class="card-title text-lg flex items-center gap-2">
                                    <ion-icon name="chatbubbles" class="text-2xl text-info"></ion-icon>
                                    Comments
                                </h2>
                                <p class="text-3xl font-bold text-info">{{ \App\Models\Comment::count() }}</p>
                            </div>
                        </a>
                    </div>

                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                        <a href="{{ route('admin.users.index') }}" class="card bg-base-100 border border-base-200 shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body">
                                <h3 class="card-title text-lg">Manage Users</h3>
                                <p class="text-base-content/60">View, ban, and manage user roles</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-sm btn-primary">Go to Users</button>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.flags.index') }}" class="card bg-base-100 border border-base-200 shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body">
                                <h3 class="card-title text-lg">Moderation</h3>
                                <p class="text-base-content/60">Review and handle flagged content</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-sm btn-error">View Flags</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Styles for animations -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    @include('ideas.modal')
</div>
