@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-base-content">Moderation Queue</h1>
                    <p class="text-base-content/70 mt-2">Review and resolve flagged content</p>
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

        <!-- Flags List -->
        <div class="space-y-4">
            @forelse($flags as $flag)
                <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div class="flex-1">
                                <h3 class="card-title flex items-center gap-2 text-lg">
                                    <span class="text-2xl">🚩</span>
                                    {{ ucfirst(str_replace('_', ' ', $flag->reason)) }}
                                </h3>
                                
                                <div class="mt-3 space-y-2">
                                    <p class="text-sm text-base-content/70">
                                        <strong>Type:</strong> {{ ucfirst(str_replace('\\', ' ', class_basename($flag->flaggable_type))) }}
                                    </p>
                                    <p class="text-sm text-base-content/70">
                                        <strong>Reported by:</strong> {{ $flag->flagged_by_name ?? 'Unknown' }}
                                    </p>
                                    <p class="text-sm text-base-content/70">
                                        <strong>Reported at:</strong> {{ $flag->created_at->format('M d, Y H:i') }}
                                    </p>
                                    @if($flag->description)
                                        <div class="mt-3 p-3 bg-base-100 rounded-lg">
                                            <p class="text-sm font-semibold text-base-content mb-1">Description:</p>
                                            <p class="text-sm text-base-content/70">{{ $flag->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 min-w-max">
                                <span class="badge" :class="@json({
                                    'badge-warning': $flag->status === 'pending',
                                    'badge-info': $flag->status === 'reviewed',
                                    'badge-success': $flag->status === 'resolved',
                                    'badge-ghost': $flag->status === 'dismissed'
                                })">
                                    {{ ucfirst($flag->status) }}
                                </span>

                                @if($flag->status === 'pending')
                                    <form method="POST" action="{{ route('admin.flags.resolve', $flag->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success w-full">Resolve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.flags.dismiss', $flag->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-ghost w-full">Dismiss</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">No flags</h3>
                        <div class="text-sm">All moderation flags have been resolved!</div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $flags->links() }}
        </div>
    </div>
</div>
@endsection
