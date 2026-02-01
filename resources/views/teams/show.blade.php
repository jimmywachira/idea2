<x-layout :title="$team->name">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Team Header -->
        <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl shadow-lg p-6 sm:p-8 mb-8 text-white">
            <div class="flex justify-between items-start gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">{{ $team->name }}</h1>
                    @if($team->description)
                        <p class="text-sm sm:text-base opacity-90">{{ $team->description }}</p>
                    @endif
                </div>
                @if($team->isOwner(auth()->user()))
                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-ghost btn-outline text-white border-white hover:bg-white hover:text-primary">
                        <ion-icon name="pencil"></ion-icon>
                        Edit
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Members Card -->
            <div class="lg:col-span-1">
                <div class="card bg-base-100 border border-base-200 shadow-md">
                    <div class="card-body">
                        <h2 class="card-title text-lg mb-4 flex items-center gap-2">
                            <ion-icon name="people" class="text-xl"></ion-icon>
                            Team Members
                        </h2>

                        <div class="space-y-3 mb-4">
                            @foreach($members as $member)
                                <div class="flex items-center justify-between p-3 bg-base-200 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm">{{ $member->name }}</p>
                                            <p class="text-xs text-base-content/60">
                                                @if($team->isOwner($member))
                                                    <span class="badge badge-primary badge-sm">Owner</span>
                                                @else
                                                    <span class="badge badge-ghost badge-sm">Member</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if($team->isOwner(auth()->user()) && !$team->isOwner($member))
                                        <form method="POST" action="{{ route('teams.removeMember', [$team, $member]) }}" onsubmit="return confirm('Remove this member?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-xs">
                                                <ion-icon name="close"></ion-icon>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Add Member -->
                        @if($team->isOwner(auth()->user()))
                            <form method="POST" action="{{ route('teams.addMember', $team) }}" class="mt-4 pt-4 border-t border-base-200">
                                @csrf
                                <div class="form-control">
                                    <label class="label p-0 mb-2">
                                        <span class="label-text text-xs font-medium">Add Member</span>
                                    </label>
                                    <div class="flex gap-2">
                                        <input 
                                            type="email" 
                                            name="email" 
                                            placeholder="user@example.com"
                                            class="input input-bordered input-sm flex-1 text-sm"
                                            required />
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <ion-icon name="add"></ion-icon>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Ideas Card -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 border border-base-200 shadow-md">
                    <div class="card-body">
                        <h2 class="card-title text-lg mb-4 flex items-center gap-2">
                            <ion-icon name="bulb" class="text-xl"></ion-icon>
                            Shared Ideas ({{ $ideas->count() }})
                        </h2>

                        @if($ideas->isEmpty())
                            <p class="text-center text-base-content/60 py-8">No ideas shared yet</p>
                        @else
                            <div class="space-y-3">
                                @foreach($ideas as $idea)
                                    <div class="p-4 bg-base-200 rounded-lg hover:bg-base-300 transition-colors">
                                        <div class="flex justify-between items-start gap-3">
                                            <div class="flex-1">
                                                <a href="{{ route('ideas.show', $idea) }}" class="font-medium text-base-content hover:text-primary transition-colors">
                                                    {{ $idea->title }}
                                                </a>
                                                <p class="text-xs text-base-content/60 mt-1">
                                                    by <a href="{{ route('profiles.show', $idea->user) }}" class="hover:text-primary">{{ $idea->user->name }}</a>
                                                </p>
                                            </div>
                                            @if($idea->user_id === auth()->id())
                                                <form method="POST" action="{{ route('teams.unshareIdea', [$team, $idea]) }}" onsubmit="return confirm('Unshare this idea?')" class="flex-shrink-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-ghost btn-xs">
                                                        <ion-icon name="close"></ion-icon>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Ideas - Available to Share -->
        @if(auth()->user()->ideas->isNotEmpty())
            <div class="card bg-base-100 border border-base-200 shadow-md">
                <div class="card-body">
                    <h2 class="card-title text-lg mb-4">
                        <ion-icon name="share-social" class="text-xl"></ion-icon>
                        Share Your Ideas
                    </h2>

                    <p class="text-sm text-base-content/60 mb-4">Select your ideas to share with the team:</p>

                    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2">
                        @foreach(auth()->user()->ideas as $userIdea)
                            <div class="p-4 border border-base-300 rounded-lg hover:border-primary transition-colors">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1">
                                        <h3 class="font-medium">{{ $userIdea->title }}</h3>
                                        <p class="text-xs text-base-content/60 mt-1">
                                            @if($userIdea->team_id === $team->id)
                                                <span class="badge badge-success badge-sm">Shared</span>
                                            @else
                                                <span class="badge badge-ghost badge-sm">Not shared</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if($userIdea->team_id !== $team->id)
                                        <form method="POST" action="{{ route('teams.shareIdea', [$team, $userIdea]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline btn-primary">Share</button>
                                        </form>
                                    @else
                                        <span class="badge badge-success">Shared</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
