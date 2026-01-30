@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-base-content">Admin Dashboard</h1>
            <p class="text-base-content/70 mt-2">Manage users, ideas, comments, and moderation flags</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg text-primary">{{ $stats['total_users'] }}</h3>
                    <p class="text-sm text-base-content/70">Total Users</p>
                </div>
            </div>
            
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg text-success">{{ $stats['total_ideas'] }}</h3>
                    <p class="text-sm text-base-content/70">Ideas Posted</p>
                </div>
            </div>
            
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg text-info">{{ $stats['total_comments'] }}</h3>
                    <p class="text-sm text-base-content/70">Comments</p>
                </div>
            </div>
            
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg text-warning">{{ $stats['banned_users'] }}</h3>
                    <p class="text-sm text-base-content/70">Banned Users</p>
                </div>
            </div>
            
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-lg text-error">{{ $stats['pending_flags'] }}</h3>
                    <p class="text-sm text-base-content/70">Pending Flags</p>
                </div>
            </div>
        </div>

        <!-- Admin Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <a href="{{ route('admin.users.index') }}" class="card bg-gradient-to-br from-primary/10 to-primary/5 border border-primary/20 hover:border-primary/50 transition-all cursor-pointer">
                <div class="card-body">
                    <h3 class="card-title flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Manage Users
                    </h3>
                    <p class="text-sm text-base-content/70">View, edit, ban users and manage roles</p>
                </div>
            </a>

            <a href="{{ route('admin.flags.index') }}" class="card bg-gradient-to-br from-error/10 to-error/5 border border-error/20 hover:border-error/50 transition-all cursor-pointer">
                <div class="card-body">
                    <h3 class="card-title flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.34 6.34a9 9 0 1112.73 12.73M6.34 6.34l8.49 8.49m0-12.73a9 9 0 11-12.73 12.73M6.34 6.34l-8.49 8.49"></path></svg>
                        Review Flags
                    </h3>
                    <p class="text-sm text-base-content/70">Review and resolve flagged content</p>
                </div>
            </a>

            <a href="{{ route('admin.ideas.index') }}" class="card bg-gradient-to-br from-success/10 to-success/5 border border-success/20 hover:border-success/50 transition-all cursor-pointer">
                <div class="card-body">
                    <h3 class="card-title flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Manage Ideas
                    </h3>
                    <p class="text-sm text-base-content/70">Delete or moderate ideas</p>
                </div>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="card bg-gradient-to-br from-info/10 to-info/5 border border-info/20 hover:border-info/50 transition-all cursor-pointer">
                <div class="card-body">
                    <h3 class="card-title flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        Manage Comments
                    </h3>
                    <p class="text-sm text-base-content/70">Delete or review comments</p>
                </div>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Ideas -->
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-lg">Recent Ideas</h2>
                    <div class="divider my-2"></div>
                    @if($recent_ideas->count() > 0)
                        <div class="space-y-3">
                            @foreach($recent_ideas as $idea)
                                <div class="flex items-start gap-3 p-3 bg-base-100 rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold truncate text-base-content">{{ $idea->title }}</h3>
                                        <p class="text-sm text-base-content/70">by {{ $idea->user->name }}</p>
                                    </div>
                                    <span class="badge badge-sm">{{ $idea->status->label() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/70 text-center py-4">No ideas yet</p>
                    @endif
                </div>
            </div>

            <!-- Recent Comments -->
            <div class="card bg-base-200/50 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-lg">Recent Comments</h2>
                    <div class="divider my-2"></div>
                    @if($recent_comments->count() > 0)
                        <div class="space-y-3">
                            @foreach($recent_comments as $comment)
                                <div class="flex items-start gap-3 p-3 bg-base-100 rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-base-content">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-base-content/70 line-clamp-2">{{ $comment->body }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/70 text-center py-4">No comments yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pending Flags -->
        @if($pending_flags->count() > 0)
            <div class="card bg-base-200/50 border border-base-300 shadow-sm mt-6">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="card-title text-lg">Pending Flags ({{ $pending_flags->count() }})</h2>
                        <a href="{{ route('admin.flags.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="divider my-2"></div>
                    <div class="space-y-2">
                        @foreach($pending_flags as $flag)
                            <div class="flex items-start gap-3 p-3 bg-base-100 rounded-lg border border-error/30">
                                <div class="flex-1">
                                    <p class="font-semibold text-base-content">{{ ucfirst(str_replace('_', ' ', $flag->reason)) }}</p>
                                    <p class="text-sm text-base-content/70">{{ $flag->description }}</p>
                                </div>
                                <span class="badge badge-error badge-sm">{{ $flag->status }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
