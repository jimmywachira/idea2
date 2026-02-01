<x-layout title="Edit Team">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Edit Team</h1>

            @if ($errors->any())
                <div role="alert" class="alert alert-error mb-6">
                    <ion-icon name="alert-circle"></ion-icon>
                    <div class="flex-1">
                        <h3 class="font-bold text-sm">{{ count($errors) }} error(s) found</h3>
                        <ul class="list-disc list-inside text-xs mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('teams.update', $team) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Team Name -->
                <div class="form-control">
                    <label class="label font-medium" for="name">
                        <span class="label-text text-sm sm:text-base">Team Name</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="e.g., AI Enthusiasts"
                        value="{{ old('name', $team->name) }}"
                        class="input input-bordered w-full text-sm sm:text-base focus:input-primary @error('name') input-error @enderror" 
                        required />
                    @error('name')
                        <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-control">
                    <label class="label font-medium" for="description">
                        <span class="label-text text-sm sm:text-base">Description</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        placeholder="What is your team about?"
                        class="textarea textarea-bordered text-sm sm:text-base focus:textarea-primary @error('description') textarea-error @enderror">{{ old('description', $team->description) }}</textarea>
                    <span class="text-xs text-base-content/60 mt-2">Max 1000 characters</span>
                    @error('description')
                        <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col-reverse sm:flex-row justify-between gap-3 pt-6">
                    <div class="flex gap-2">
                        <a href="{{ route('teams.show', $team) }}" class="btn btn-ghost btn-sm sm:btn-md">Cancel</a>
                        <form method="POST" action="{{ route('teams.destroy', $team) }}" onsubmit="return confirm('Delete this team? This cannot be undone.')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error btn-sm sm:btn-md">
                                <ion-icon name="trash"></ion-icon>
                                Delete
                            </button>
                        </form>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm sm:btn-md">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
