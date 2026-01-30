@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-base-content">Manage Ideas</h1>
                    <p class="text-base-content/70 mt-2">View all ideas and delete inappropriate content</p>
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

        <!-- Ideas Grid -->
        <div class="grid grid-cols-1 gap-4">
            @forelse($ideas as $idea)
                <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div class="flex-1">
                                <h2 class="card-title text-xl">{{ $idea->title }}</h2>
                                <p class="text-base-content/70 mt-2">{{ Str::limit($idea->description, 150) }}</p>
                                
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="badge badge-primary">{{ $idea->user->name }}</span>
                                    <span class="badge" :class="@json({
                                        'badge-warning': $idea->status->value === 'pending',
                                        'badge-info': $idea->status->value === 'in_progress',
                                        'badge-success': $idea->status->value === 'completed'
                                    })">
                                        {{ $idea->status->label() }}
                                    </span>
                                    <span class="badge badge-ghost">{{ $idea->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 min-w-max">
                                <a href="{{ route('ideas.show', $idea) }}" class="btn btn-sm btn-info">View</a>
                                <form method="POST" action="{{ route('admin.ideas.destroy', $idea) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this idea?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error w-full">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">No ideas</h3>
                        <div class="text-sm">There are no ideas to manage</div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $ideas->links() }}
        </div>
    </div>
</div>
@endsection
