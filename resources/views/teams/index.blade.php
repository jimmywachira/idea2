<x-layout title="My Teams">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="mb-8 sm:mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-base-content mb-2">My Teams</h1>
                <p class="text-base sm:text-lg text-base-content/60">Create and manage teams to collaborate on ideas</p>
            </div>
            <a href="{{ route('teams.create') }}" class="btn btn-primary gap-2">
                <ion-icon name="add-circle" class="text-xl"></ion-icon>
                <span>Create Team</span>
            </a>
        </div>

        <!-- Teams Grid -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($teams as $team)
                <div class="card bg-base-100 border border-base-200 shadow-md hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <!-- Header -->
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

                        <!-- Description -->
                        @if($team->description)
                            <p class="text-sm text-base-content/70 mb-4 line-clamp-2">{{ $team->description }}</p>
                        @else
                            <p class="text-sm text-base-content/50 italic mb-4">No description</p>
                        @endif

                        <!-- Stats -->
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

                        <!-- Actions -->
                        <div class="card-actions gap-2">
                            <a href="{{ route('teams.show', $team) }}" class="btn btn-sm btn-primary flex-1">View</a>
                            @if($team->isOwner(auth()->user()))
                                <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-ghost">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center justify-center py-16 text-center bg-gradient-to-br from-base-100 to-base-200/50 rounded-2xl border-2 border-dashed border-base-300">
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
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
