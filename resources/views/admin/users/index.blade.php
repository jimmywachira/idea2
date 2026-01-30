@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-base-content">Manage Users</h1>
                    <p class="text-base-content/70 mt-2">View all users, change roles, and manage bans</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">← Back to Dashboard</a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if ($errors->any())
            <div class="alert alert-error shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m9-11a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="font-bold">Error</h3>
                    <div class="text-sm">{{ $errors->first() }}</div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="font-bold">Success</h3>
                    <div class="text-sm">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <!-- Users Table -->
        <div class="card bg-base-200/50 border border-base-300 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300/50">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($user->avatar_path)
                                            <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full">
                                        @else
                                            <div class="avatar placeholder">
                                                <div class="bg-primary text-white rounded-full w-8">
                                                    <span>{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <span class="font-semibold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="badge" :class="@json({
                                        'badge-neutral': $user->role->value === 'user',
                                        'badge-warning': $user->role->value === 'moderator',
                                        'badge-error': $user->role->value === 'admin'
                                    })">
                                        {{ $user->role->label() }}
                                    </div>
                                </td>
                                <td>
                                    @if($user->isBanned())
                                        <div class="badge badge-error">Banned</div>
                                    @else
                                        <div class="badge badge-success">Active</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <!-- Change Role -->
                                        @if(auth()->user()->id !== $user->id)
                                            <form method="POST" action="{{ route('admin.users.changeRole', $user) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-ghost tooltip" data-tip="Change role: {{ $user->role->value === 'user' ? 'moderator' : ($user->role->value === 'moderator' ? 'admin' : 'user') }}">
                                                    Change Role
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Ban/Unban -->
                                        @if(!$user->isBanned())
                                            <form method="POST" action="{{ route('admin.users.ban', $user) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-error tooltip" data-tip="Ban this user">
                                                    Ban
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.unban', $user) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-success tooltip" data-tip="Unban this user">
                                                    Unban
                                                </button>
                                            </form>
                                        @endif

                                        <!-- View Profile -->
                                        <a href="{{ route('profiles.show', $user) }}" class="btn btn-xs btn-info">View</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8">
                                    <p class="text-base-content/70">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-body">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
