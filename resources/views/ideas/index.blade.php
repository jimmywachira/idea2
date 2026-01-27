<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-2xl font-bold">All Ideas</h1>
            <p class="text-sm m-4 text-muted-foreground">Your ideas, at a glance</p>

            <x-card 
                x-data
                @click="$dispatch('open-modal', { name: 'create-idea' })"
                is="button" 
                data-test="create-idea-button"
                class="w-full cursor-pointer h-16 text-left p-6">
                Whats Your Idea ?
            </x-card>
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

        <x-modal name="create-idea" title="create-idea">
            <fieldset class="fieldset-legend bg-base-400 text-2xl mb-4">Create New Idea</fieldset>
                <form x-data="{ status: '', newLink: '', link: [] }" action="{{ route('ideas.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <x-form.field name="title" label="Title" placeholder="Enter your idea title" />

                    <div class="form-control w-full space-y-2"> 
                        <label class="label">Status</label>
                        <div class="flex gap-x-3 ">
                            @foreach(\App\IdeaStatus::cases() as $status)
                                <button type="button"
                                @click="status = '{{ $status->value }}'"  
                                class="btn flex-1 h-10" 
                                data-test="button-status-{{ $status->value }}"
                                :class="status === '{{ $status->value }}' ? 'btn-primary ' : 'btn-outline'">
                                {{ $status->label() }}
                                </button>
                            @endforeach
                            <input type="hidden" name="status" :value="status" />
                        </div>
                        <x-form.error name="status" />
                    </div>

                    <x-form.field name="description" label="Description" type="textarea" placeholder="Describe your idea" />

                    <div>
                        <fieldset class="fieldset border-base-300 rounded-box w-full border p-4">
                            <legend class="label">Optional Links</legend>
                            <div class="form-control w-full space-y-2">
                                <template x-for="link in link" >
                                    <input type='text' name='links[]'  x-model='link' />
                                </template>

                                <input x-model="newLink" 
                                    type="url" id="new-link" 
                                    placeholder="https://example.com" 
                                    autocomplete="url" spellcheck="false" 
                                    class="input input-bordered flex-1 mb-2" />
                                
                                <x-form.error name="links" />

                                <button type="button" 
                                @click="link.push(newLink.trim()); newLink = ''" 
                                class=""
                                :disabled="!newLink.trim().length===0"
                                data-test="add-link-button"
                                >
                                <ion-icon class="text-primary" name="add-outline" size="large"></ion-icon></button>
                                <pre class="mt-4" x-text="newLink"></pre>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="show = false" class="btn btn-ghost">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Idea</button>
                    </div>
                </form>
            </fieldset>    
        </x-modal>

    </div>
</x-layout>
