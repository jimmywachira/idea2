<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Navigation -->
        <div class="mb-8">
            <a href="{{ route('ideas.index') }}" class="btn btn-ghost border p-2 border-gray-600/50 gap-2 pl-0 hover:bg-transparent hover:text-primary transition-colors group">
                <ion-icon name="arrow-back" class="ml-2 group-hover:-translate-x-1 transition-transform"></ion-icon> 
                Back to Board
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Idea Header & Description -->
                <div class="card bg-base-100 shadow-sm border border-base-200 overflow-visible">
                    <div class="card-body p-6 sm:p-8">
                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8 border-b border-base-200 pb-6">
                            <div class="space-y-2 flex-1 min-w-0">
                                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-base-content tracking-tight leading-tight break-words">
                                    {{ $idea->title }}
                                </h1>

                                <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm text-base-content/60">
                                    <div class="flex items-center gap-1.5 bg-base-200/50 px-2 py-1 rounded-md">
                                        <ion-icon name="person-circle-outline" class="text-lg"></ion-icon>
                                        <a href="{{ route('profiles.show', $idea->user) }}" class="font-medium text-base-content hover:text-primary truncate">
                                            {{ $idea->user->name }}
                                        </a>
                                    </div>
                                    <span class="hidden sm:inline">&bull;</span>
                                    <span title="{{ $idea->created_at }}" class="hidden sm:inline">{{ $idea->created_at->format('M d, Y') }}</span>
                                    <span class="hidden sm:inline">&bull;</span>
                                    <span>{{ $idea->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="flex flex-shrink-0 items-center gap-3 self-start sm:self-auto">
                                <x-ideas.status-label status="{{ $idea->status }}" />
                                <form action="{{ route('ideas.like', $idea) }}" method="POST" class="min-w-max">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $idea->likedBy() ? 'btn-primary' : 'btn-ghost' }} gap-2">
                                        <ion-icon name="heart" class="text-lg"></ion-icon>
                                        <span>{{ $idea->likesCount() }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-8 overflow-hidden rounded-2xl border border-base-200 shadow-sm bg-base-200/50">
                            @if($idea->image_path)
                                <img src="{{ asset('storage/' . $idea->image_path) }}" alt="{{ $idea->title }}" class="w-full h-auto max-h-[500px] object-cover">
                            @else
                                <img src="https://picsum.photos/seed/{{ $idea->id }}/1200/600" 
                                     alt="{{ $idea->title }}" 
                                     class="w-full h-auto max-h-[400px] object-cover opacity-90 hover:opacity-100 transition-opacity"
                                     loading="lazy">
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none prose-headings:text-base-content prose-p:text-base-content/80 prose-a:text-primary break-words">
                            {{ $idea->description }}
                        </div>
                    </div>
                </div>

                <!-- Steps Section -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-6 sm:p-8">
                        <h3 class="card-title text-lg sm:text-xl mb-6 flex items-center gap-2 text-base-content">
                            <div class="p-2 bg-secondary/10 rounded-lg text-secondary flex-shrink-0">
                                <ion-icon name="list"></ion-icon>
                            </div>
                            <span class="break-words">Steps to Implement</span>
                        </h3>

                        @if($idea->steps->isEmpty())
                            <div class="flex flex-col items-center justify-center py-8 text-center bg-base-200/30 rounded-xl border border-dashed border-base-300">
                                <ion-icon name="footsteps-outline" class="text-3xl text-base-content/20 mb-2"></ion-icon>
                                <p class="text-base-content/50 italic text-sm">No specific steps provided.</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($idea->steps as $index => $step)
                                    <div class="flex items-start gap-4 p-4 rounded-xl transition-all {{ $step->completed ? 'bg-success/10 border-success/20' : 'bg-base-200/50 border-base-300' }} border hover:shadow-md">
                                        <form action="{{ route('steps.update', $step) }}" method="POST" class="flex-shrink-0">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                role="checkbox"
                                                aria-checked="{{ $step->completed ? 'true' : 'false' }}"
                                                class="w-6 h-6 flex items-center justify-center rounded-full border-2 transition-all {{ $step->completed ? 'bg-success border-success text-success-content' : 'border-base-content/30 hover:border-primary' }}"
                                            >
                                                @if($step->completed)
                                                    <ion-icon name="checkmark" class="text-sm"></ion-icon>
                                                @endif
                                            </button>
                                        </form>

                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start gap-2">
                                                <span class="badge badge-sm badge-ghost flex-shrink-0">{{ $index + 1 }}</span>
                                                <span class="break-words text-sm sm:text-base {{ $step->completed ? 'line-through text-base-content/60' : 'text-base-content' }}">
                                                    {{ $step->description }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-6 sm:p-8">
                        <h3 class="card-title text-lg sm:text-xl mb-6 flex items-center gap-2 text-base-content">
                            <div class="p-2 bg-primary/10 rounded-lg text-primary flex-shrink-0">
                                <ion-icon name="chatbubbles"></ion-icon>
                            </div>
                            <span>Comments</span>
                            <span class="badge badge-primary badge-sm">{{ $idea->comments()->count() }}</span>
                        </h3>

                        @auth
                        <form action="{{ route('comments.store', $idea) }}" method="POST" class="mb-6" x-data="{ isSubmitting: false }" @submit="isSubmitting = true">
                            @csrf
                            <div class="form-control">
                                <textarea name="body" rows="3" class="textarea textarea-bordered w-full text-sm" placeholder="Add your thoughts..." required></textarea>
                                <x-form.error name="body" />
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="btn btn-primary btn-sm" :disabled="isSubmitting">
                                    <ion-icon name="send" class="mr-1"></ion-icon>
                                    <span x-text="isSubmitting ? 'Posting...' : 'Post Comment'"></span>
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-info mb-6">
                            <ion-icon name="information-circle"></ion-icon>
                            <span>Please <a href="{{ route('login') }}" class="link link-primary">log in</a> to comment.</span>
                        </div>
                        @endauth

                        <div class="space-y-4">
                            @forelse($idea->comments as $comment)
                                <div class="p-4 rounded-xl border border-base-200 bg-base-200/40 hover:bg-base-200/60 transition-colors">
                                    <div class="flex justify-between items-start gap-3">
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs sm:text-sm text-base-content/70 mb-2">
                                                <a href="{{ route('profiles.show', $comment->user) }}" class="font-medium text-base-content hover:text-primary inline-flex items-center gap-1">
                                                    <ion-icon name="person-circle" class="text-base"></ion-icon>
                                                    <span class="truncate">{{ $comment->user->name }}</span>
                                                </a>
                                                <span class="text-xs text-base-content/40 ml-1">&bull; {{ $comment->created_at->diffForHumans() }}</span>
                                            </p>
                                            <p class="text-base-content/90 text-sm break-words leading-relaxed">{{ $comment->body }}</p>
                                        </div>
                                        @if(auth()->check() && auth()->id() === $comment->user_id)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" x-data="{ isDeleting: false }" @submit="isDeleting = true">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-ghost text-error flex-shrink-0" :disabled="isDeleting">
                                                    <ion-icon :name="isDeleting ? 'hourglass-outline' : 'trash-outline'"></ion-icon>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-base-content/40 text-sm bg-base-200/20 rounded-xl border border-dashed border-base-300">
                                    <ion-icon name="chatbubbles-outline" class="text-3xl mb-3 opacity-50"></ion-icon>
                                    <p class="italic">No comments yet. Be the first to share your thoughts!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="space-y-6 order-first lg:order-last">
                
                <!-- Engagement Stats Panel -->
                <div class="card bg-gradient-to-br from-primary/5 to-secondary/5 shadow-sm border border-base-200">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-xs uppercase tracking-wider text-base-content/40 mb-4 flex items-center gap-2">
                            <ion-icon name="stats-chart"></ion-icon>
                            Engagement
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-base-100 rounded-lg p-3 text-center">
                                <div class="flex items-center justify-center gap-1 text-error mb-1">
                                    <ion-icon name="heart" class="text-xl"></ion-icon>
                                </div>
                                <div class="text-2xl font-bold text-base-content">{{ $idea->likesCount() }}</div>
                                <div class="text-xs text-base-content/60">Likes</div>
                            </div>
                            <div class="bg-base-100 rounded-lg p-3 text-center">
                                <div class="flex items-center justify-center gap-1 text-primary mb-1">
                                    <ion-icon name="chatbubbles" class="text-xl"></ion-icon>
                                </div>
                                <div class="text-2xl font-bold text-base-content">{{ $idea->comments()->count() }}</div>
                                <div class="text-xs text-base-content/60">Comments</div>
                            </div>
                            <div class="bg-base-100 rounded-lg p-3 text-center">
                                <div class="flex items-center justify-center gap-1 text-secondary mb-1">
                                    <ion-icon name="list" class="text-xl"></ion-icon>
                                </div>
                                <div class="text-2xl font-bold text-base-content">{{ $idea->steps->count() }}</div>
                                <div class="text-xs text-base-content/60">Steps</div>
                            </div>
                            <div class="bg-base-100 rounded-lg p-3 text-center">
                                <div class="flex items-center justify-center gap-1 text-info mb-1">
                                    <ion-icon name="link" class="text-xl"></ion-icon>
                                </div>
                                <div class="text-2xl font-bold text-base-content">{{ $idea->links ? count($idea->links) : 0 }}</div>
                                <div class="text-xs text-base-content/60">Links</div>
                            </div>
                        </div>
                    </div>
                </div>

                @can('update', $idea)
                <!-- Actions Panel -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-xs uppercase tracking-wider text-base-content/40 mb-4 flex items-center gap-2">
                            <ion-icon name="settings"></ion-icon>
                            Manage Idea
                        </h3>
                        <div class="flex flex-col gap-3">
                            <button 
                                x-data 
                                @click="$dispatch('open-idea-form', { idea: {{ Js::from($idea->load('steps')) }} })"
                                class="btn text-primary border border-primary w-full gap-2 shadow shadow-primary hover:bg-primary/50 text-sm">
                                <ion-icon name="create-outline" class="text-lg"></ion-icon>
                                <span>Edit Idea</span>
                            </button>
                            
                            <form action="{{ route('ideas.destroy', $idea) }}" method="POST" x-data="{ isDeleting: false }" @submit="isDeleting = true">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-error w-full gap-2 hover:bg-error/10 text-sm" :disabled="isDeleting" onclick="return confirm('Are you sure you want to delete this idea? This action cannot be undone.')">
                                    <ion-icon :name="isDeleting ? 'hourglass-outline' : 'trash-outline'" class="text-lg"></ion-icon>
                                    <span x-text="isDeleting ? 'Deleting...' : 'Delete Idea'"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endcan

                <!-- Links Panel -->
                <div class="card bg-base-100 shadow-sm border border-base-200">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-xs uppercase tracking-wider text-base-content/40 mb-4 flex items-center gap-2">
                            <ion-icon name="link"></ion-icon>
                            External Resources
                        </h3>
                        
                        @if($idea->links && count($idea->links) > 0)
                            <ul class="space-y-2">
                                @foreach($idea->links as $index => $link)
                                    <li>
                                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-3 rounded-xl bg-base-200/50 hover:bg-base-200 border border-transparent hover:border-primary/30 hover:shadow-md transition-all group">
                                            <div class="p-2 bg-base-100 rounded-lg text-primary shadow-sm flex-shrink-0">
                                                <ion-icon name="globe-outline"></ion-icon>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-base-content/50 mb-0.5">Resource {{ $index + 1 }}</p>
                                                <p class="text-sm font-medium text-base-content truncate group-hover:text-primary transition-colors">{{ parse_url($link, PHP_URL_HOST) ?? 'External Link' }}</p>
                                            </div>
                                            <ion-icon name="arrow-forward" class="text-base-content/30 group-hover:text-primary group-hover:translate-x-1 transition-all flex-shrink-0"></ion-icon>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-8 text-base-content/40 text-sm bg-base-200/20 rounded-xl border border-dashed border-base-300">
                                <ion-icon name="link-outline" class="text-2xl mb-2 opacity-50"></ion-icon>
                                <p class="italic">No external resources</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('ideas.form-modal')
</x-layout>