<x-layout title="{{ $user->name }}'s Profile">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Profile Header -->
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8 mb-8">
            <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 items-start">
                <!-- Avatar -->
                <div class="flex-shrink-0 w-24 sm:w-32 h-24 sm:h-32">
                    @if($user->avatar_path)
                        <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full rounded-2xl object-cover border-4 border-primary/20">
                    @else
                        <div class="w-full h-full rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-3xl sm:text-4xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <!-- Profile Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-4">
                        <div class="min-w-0">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1 break-words">{{ $user->name }}</h1>
                            <p class="text-sm sm:text-base text-base-content/60 truncate mb-3">{{ $user->email }}</p>
                        </div>

                        @if(auth()->check() && auth()->id() === $user->id)
                            <a href="{{ route('profiles.edit') }}" class="btn btn-primary btn-sm self-start sm:self-auto">Edit Profile</a>
                        @endif
                    </div>

                    @if($user->bio)
                        <p class="text-base text-base-content mb-6 max-w-2xl break-words">{{ $user->bio }}</p>
                    @else
                        <p class="text-base-content/50 italic mb-6 text-sm">No bio yet</p>
                    @endif

                    <!-- Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                        <div class="stat p-3 sm:p-4 bg-base-200/50 rounded-lg">
                            <div class="stat-title text-xs sm:text-sm font-medium">Total Ideas</div>
                            <div class="stat-value text-lg sm:text-2xl text-primary">{{ $ideaCount }}</div>
                        </div>
                        <div class="stat p-3 sm:p-4 bg-base-200/50 rounded-lg">
                            <div class="stat-title text-xs sm:text-sm font-medium">Completed</div>
                            <div class="stat-value text-lg sm:text-2xl text-success">{{ $completedCount }}</div>
                        </div>
                        <div class="stat p-3 sm:p-4 bg-base-200/50 rounded-lg">
                            <div class="stat-title text-xs sm:text-sm font-medium">Member Since</div>
                            <div class="stat-desc text-xs sm:text-sm">{{ $user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ideas Section -->
        <div>
            <h2 class="text-xl sm:text-2xl font-bold mb-6">Ideas by {{ $user->name }}</h2>

            @if($ideas->count() > 0)
                <div class="grid gap-4 sm:gap-6">
                    @foreach($ideas as $idea)
                        <div class="bg-base-100 rounded-xl shadow border border-base-200 p-4 sm:p-6 hover:shadow-lg transition-shadow">
                            <div class="flex flex-col gap-4">
                                <div class="min-w-0">
                                    <a href="{{ route('ideas.show', $idea) }}" class="text-lg sm:text-xl font-semibold hover:text-primary transition break-words">
                                        {{ $idea->title }}
                                    </a>
                                    <p class="text-sm sm:text-base text-base-content/60 mt-2 break-words">{{ Str::limit($idea->description, 150) }}</p>

                                    <div class="flex flex-wrap gap-3 mt-4 items-center">
                                        <x-ideas.status-label status="{{ $idea->status }}" />
                                        <span class="text-xs sm:text-sm text-base-content/50">
                                            {{ $idea->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-base-100 rounded-xl border border-base-200">
                    <ion-icon name="bulb-outline" class="text-5xl sm:text-6xl text-base-content/20 mb-4"></ion-icon>
                    <p class="text-base-content/60 text-base sm:text-lg">No ideas yet</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
