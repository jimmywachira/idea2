<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
    <header class="text-center mb-8">
        <h1 class="text-2xl font-bold">All Ideas</h1>
        <p class="text-sm m-4 text-muted-foreground">Your ideas, at a glance</p>
    </header>

    <div class="flex justify-start">
        <a href="{{ route('ideas.index') }}"
           class="m-4 text-sm px-3 py-1 rounded-full {{ request('status') === null ? 'bg-primary text-white' : 'bg-gray-400 text-gray-700' }}">
            All
        </a>
        @foreach(\App\IdeaStatus::cases() as $status)
            <a href="{{ route('ideas.index', ['status' => $status->value]) }}"
               class="m-4 text-sm px-3 py-1 rounded-full {{ request('status') === $status->value ? 'bg-primary text-white' : 'bg-gray-400 text-gray-700' }}">
                {{ \Illuminate\Support\Str::headline($status->value) }} <span class="ml-1 bg-white text-gray-800 px-2 rounded-full text-xs">{{ auth()->user()->ideas()->where('status', $status->value)->count() }}</span>
            </a>
        @endforeach
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        @forelse($ideas as $idea)
            <x-card href="{{ route('ideas.show', $idea->id) }}" class="hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-semibold text-gray-400">{{ $idea->title }}</h3>

                <x-ideas.status-label status="{{ $idea->status }}" />

                <div class="mt-2 text-sm prose">
                    {{ $idea->description }}
                </div>

                <div class="mt-4 text-xs text-muted-foreground">
                    {{ $idea->created_at->diffForHumans() }}
                </div>
            </x-card>
        @empty
        <x-card>
            <p>No ideas at this time.</p>
        </x-card>
        @endforelse
    </div>
    </div>
</x-layout>
