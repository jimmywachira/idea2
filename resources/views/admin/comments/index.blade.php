@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-base-content">Manage Comments</h1>
                    <p class="text-base-content/70 mt-2">View all comments and delete inappropriate content</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">← Back to Dashboard</a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="font-bold">Success</h3>
                    <div class="text-sm">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <!-- Comments List -->
        <div class="space-y-4">
            @forelse($comments as $comment)
                <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    @if($comment->user->avatar_path)
                                        <img src="{{ asset('storage/' . $comment->user->avatar_path) }}" alt="{{ $comment->user->name }}" class="w-6 h-6 rounded-full">
                                    @else
                                        <div class="avatar placeholder">
                                            <div class="bg-primary text-white rounded-full w-6">
                                                <span class="text-xs">{{ substr($comment->user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <span class="font-semibold text-base-content">{{ $comment->user->name }}</span>
                                </div>
                                
                                <p class="text-base-content/70 mb-3">{{ $comment->body }}</p>
                                
                                <div class="flex flex-wrap gap-2 text-sm">
                                    <span class="badge badge-ghost">{{ $comment->created_at->format('M d, Y H:i') }}</span>
                                    <a href="{{ route('ideas.show', $comment->idea) }}" class="badge badge-outline cursor-pointer">
                                        on "{{ Str::limit($comment->idea->title, 30) }}"
                                    </a>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 min-w-max">
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">No comments</h3>
                        <div class="text-sm">There are no comments to manage</div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection
