<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <!-- Dashboard Header -->
        <div class="mb-8 sm:mb-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">Idea Board</h1>
            <p class="text-base sm:text-lg text-base-content/60">Manage, track, and collaborate on your next big thing.</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8 sm:mb-10">
            <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                <div class="stat p-4 sm:p-6">
                    <div class="stat-figure text-primary bg-primary/10 p-2 sm:p-3 rounded-full">
                        <ion-icon name="bulb" class="text-2xl sm:text-3xl"></ion-icon>
                    </div>
                    <div class="stat-title font-medium text-xs sm:text-sm">Total Ideas</div>
                    <div class="stat-value text-primary text-2xl sm:text-4xl">{{ auth()->user()->ideas()->count() }}</div>
                    <div class="stat-desc text-xs">Lifetime contributions</div>
                </div>
            </div>
            
            <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                <div class="stat p-4 sm:p-6">
                    <div class="stat-figure text-warning bg-warning/10 p-2 sm:p-3 rounded-full">
                        <ion-icon name="time" class="text-2xl sm:text-3xl"></ion-icon>
                    </div>
                    <div class="stat-title font-medium text-xs sm:text-sm">In Progress</div>
                    <div class="stat-value text-warning text-2xl sm:text-4xl">{{ auth()->user()->ideas()->where('status', 'in_progress')->count() }}</div>
                    <div class="stat-desc text-xs">Currently active</div>
                </div>
            </div>

            <div class="stats shadow-md hover:shadow-xl transition-shadow border border-base-200 bg-base-100">
                <div class="stat p-4 sm:p-6">
                    <div class="stat-figure text-success bg-success/10 p-2 sm:p-3 rounded-full">
                        <ion-icon name="checkmark-circle" class="text-2xl sm:text-3xl"></ion-icon>
                    </div>
                    <div class="stat-title font-medium text-xs sm:text-sm">Completed</div>
                    <div class="stat-value text-success text-2xl sm:text-4xl">{{ auth()->user()->ideas()->where('status', 'completed')->count() }}</div>
                    <div class="stat-desc text-xs">Successfully shipped</div>
                </div>
            </div>
        </div>

        <!-- Actions Toolbar -->
        <div class="bg-base-100 p-4 sm:p-6 rounded-xl border border-base-200 shadow-md mb-8">
            <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4">
                <!-- Search Bar -->
                <form method="GET" action="{{ route('ideas.index') }}" class="flex gap-2 w-full lg:w-auto lg:min-w-[300px]">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-base-content/50">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search ideas..." 
                            value="{{ $search ?? '' }}"
                            class="input input-bordered w-full pl-10 focus:input-primary" />
                    </div>
                    <button type="submit" class="btn btn-primary gap-2">
                        <ion-icon name="search" class="text-lg"></ion-icon>
                        <span class="hidden sm:inline">Search</span>
                    </button>
                </form>

                <!-- Create Button -->
                <button 
                    x-data
                    @click="$dispatch('open-idea-form', { idea: null })"
                    class="btn btn-primary gap-2 shadow-lg shadow-primary/20 w-full lg:w-auto">
                    <ion-icon name="add-circle" class="text-xl"></ion-icon>
                    <span>New Idea</span>
                </button>
            </div>

            <!-- Filter Tabs -->
            <div class="mt-4 pt-4 border-t border-base-200">
                <div class="flex items-center gap-2 mb-2">
                    <ion-icon name="filter" class="text-base-content/60"></ion-icon>
                    <span class="text-sm font-medium text-base-content/60">Filter by status:</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('ideas.index') }}" 
                       class="btn btn-sm rounded-full {{ request('status') === null ? 'btn-primary' : 'btn-ghost bg-base-200' }} normal-case font-medium border-0">
                       All Ideas
                    </a>
                    @foreach(\App\IdeaStatus::cases() as $status)
                        <a href="{{ route('ideas.index', ['status' => $status->value]) }}"
                           class="btn btn-sm rounded-full {{ request('status') === $status->value ? 'btn-primary' : 'btn-ghost bg-base-200' }} normal-case font-medium border-0">
                            {{ $status->label() }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Ideas Grid -->
        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($ideas as $idea)
                <x-card is="div" class="!p-0 group hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-base-200 bg-base-100 h-full flex flex-col relative overflow-hidden">
                    <!-- Status Line -->
                    <div class="absolute top-0 left-0 w-full h-1 {{ $idea->status === 'completed' ? 'bg-success' : ($idea->status === 'in_progress' ? 'bg-warning' : 'bg-primary') }}"></div>

                    <div class="p-6 flex flex-col h-full">
                        <!-- Meta Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-2 text-xs text-base-content/60 font-medium">
                                <ion-icon name="calendar-clear-outline" class="text-sm"></ion-icon>
                                <span>{{ $idea->created_at->format('M d, Y') }}</span>
                            </div>
                            <x-ideas.status-label status="{{ $idea->status }}" />
                        </div>

                        <!-- Content -->
                        <div class="mb-6 flex-grow">
                            <!-- Idea Image -->
                            <div class="mb-4 -mt-4 overflow-hidden rounded-lg">
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
                        
                        <!-- Footer -->
                        <div class="pt-4 border-t border-base-200 flex items-center justify-between mt-auto">
                            <!-- Author -->
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

                            <!-- Stats -->
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
                        </div>
                    </div>
                </x-card>
            @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center justify-center py-16 sm:py-20 text-center bg-gradient-to-br from-base-100 to-base-200/50 rounded-2xl border-2 border-dashed border-base-300 shadow-inner">
                        <div class="bg-gradient-to-br from-primary/10 to-secondary/10 p-8 rounded-full mb-6 animate-pulse">
                            <ion-icon name="bulb-outline" class="text-6xl text-primary"></ion-icon>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-bold mb-3">{{ request('status') ? 'No ideas found' : 'Your Idea Board Awaits!' }}</h3>
                        <p class="text-base-content/60 max-w-md mx-auto mb-8 px-4 text-sm sm:text-base">
                            @if(request('search'))
                                No ideas match "<span class="font-semibold text-primary">{{ request('search') }}</span>". Try a different search term.
                            @elseif(request('status'))
                                No ideas found with <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', request('status'))) }}</span> status. Try a different filter.
                            @else
                                Ready to transform your thoughts into action? Create your first idea and start building something amazing!
                            @endif
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button 
                                x-data
                                @click="$dispatch('open-idea-form', { idea: null })"
                                class="btn btn-primary px-8 gap-2">
                                <ion-icon name="add-circle" class="text-xl"></ion-icon>
                                {{ request('status') || request('search') ? 'Create New Idea' : 'Create First Idea' }}
                            </button>
                            @if(request('status') || request('search'))
                                <a href="{{ route('ideas.index') }}" class="btn btn-ghost">
                                    <ion-icon name="refresh" class="text-lg"></ion-icon>
                                    Clear Filters
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($ideas->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $ideas->links() }}
            </div>
        @endif

        @include('ideas.form-modal')

    </div>
</x-layout>
