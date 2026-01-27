<x-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <header class="mb-8">
            

            <h1 class="text-3xl font-bold mb-2">{{ $idea->title }}</h1>
            <x-ideas.status-label status="{{ $idea->status }}" />
            <p class="text-sm text-muted-foreground mt-2">Submitted {{ $idea->created_at->diffForHumans() }} by {{ $idea->user->name }}</p>
        </header>

        <div class="prose mb-8">
            {{ $idea->description }}
        </div>

        <section>
            <h2 class="text-2xl font-semibold mb-4">Steps to Reproduce</h2>
            @if($idea->steps->isEmpty())
                <p class="text-muted-foreground">No steps provided.</p>
            @else
                <ol class="list-decimal list-inside space-y-2">
                    @foreach($idea->steps as $step)
                        <li>{{ $step->description }}</li>
                    @endforeach
                </ol>
            @endif
        </section>

        <div class="mt-8 text-primary">
            @if($idea->links && count($idea->links))
                <h3 class="mt-6 text-2xl font-semibold">Links</h3>
                <div class="mt-2 space-y-2">
                   @foreach($idea->links as $link)
                    <li><a href="{{ $link }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-blue-600 hover:underline">
                            <span class="truncate">{{ $link }}</span>
                            <x-icons.external class="w-4 h-4 text-gray-500" />
                        </a>
                    </li>
               </div>

                @endforeach
                @else
                  <p class="text-muted-foreground">No links provided.</p>
            @endif
        </div>

        <div class="mt-8">
            <nav class="flex justify-end items-center m-4">
                <div class="flex items-center gap-2">

                <a href="{{ route('ideas.index') }}" class="btn btn-outline text-sm font-medium"> 
                    Back To Ideas
                </a>
                    
                <a href="#" class="btn bg-primary text-white">Edit Idea</a>
                    <form action="{{ route('ideas.destroy', $idea) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline text-red-600">Delete</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</x-layout>