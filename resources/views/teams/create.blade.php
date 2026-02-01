<x-layout title="Create Team">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Create a New Team</h1>

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

            <form action="{{ route('teams.store') }}" method="POST" class="space-y-6">
                @csrf

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
                        value="{{ old('name') }}"
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
                        placeholder="What is your team about? What will you collaborate on?"
                        class="textarea textarea-bordered text-sm sm:text-base focus:textarea-primary @error('description') textarea-error @enderror">{{ old('description') }}</textarea>
                    <span class="text-xs text-base-content/60 mt-2">Max 1000 characters</span>
                    @error('description')
                        <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Help Text -->
                <div class="alert alert-info">
                    <ion-icon name="information-circle" class="text-lg"></ion-icon>
                    <div class="flex-1 text-xs sm:text-sm">
                        <p><strong>How it works:</strong> After creating your team, you'll be able to add members and share your ideas with them. Team members can view ideas but only the owner can update or delete them.</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col-reverse sm:flex-row justify-between gap-3 pt-6">
                    <a href="{{ route('teams.index') }}" class="btn btn-ghost btn-sm sm:btn-md text-center">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm sm:btn-md">Create Team</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
