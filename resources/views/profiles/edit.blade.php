<x-layout title="Edit Profile">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Edit Your Profile</h1>

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

            <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Avatar -->
                <div class="form-control">
                    <label class="label font-medium">
                        <span class="label-text text-sm sm:text-base">Current Avatar</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 flex-shrink-0">
                            @if($user->avatar_path)
                                <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full rounded-lg object-cover border-2 border-primary/20">
                            @else
                                <div class="w-full h-full rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-2xl font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <span class="text-xs sm:text-sm text-base-content/60">Click below to change avatar</span>
                    </div>
                </div>

                <!-- Avatar Upload -->
                <div class="form-control">
                    <label class="label font-medium" for="avatar">
                        <span class="label-text text-sm sm:text-base">Upload New Avatar</span>
                    </label>
                    <input 
                        type="file" 
                        id="avatar" 
                        name="avatar" 
                        accept="image/*"
                        class="file-input file-input-bordered w-full focus:file-input-primary text-sm @error('avatar') file-input-error @enderror" />
                    <span class="text-xs text-base-content/60 mt-2">Max 2MB, formats: JPG, PNG, GIF</span>
                    @error('avatar')
                        <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="form-control">
                    <label class="label font-medium" for="bio">
                        <span class="label-text text-sm sm:text-base">Bio</span>
                    </label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4"
                        placeholder="Tell us about yourself..."
                        class="textarea textarea-bordered text-sm sm:text-base focus:textarea-primary @error('bio') textarea-error @enderror">{{ old('bio', $user->bio) }}</textarea>
                    <span class="text-xs text-base-content/60 mt-2">Max 500 characters</span>
                    @error('bio')
                        <span class="text-error text-xs sm:text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col-reverse sm:flex-row justify-between gap-3 pt-6">
                    <a href="{{ route('profiles.show', $user) }}" class="btn btn-ghost btn-sm sm:btn-md text-center">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm sm:btn-md">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
