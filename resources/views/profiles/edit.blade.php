<x-layout title="Edit Profile">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200 p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Edit Your Profile</h1>

            @if ($errors->any())
                <div role="alert" class="alert alert-error mb-6">
                    <ion-icon name="alert-circle"></ion-icon>
                    <div class="flex-1">
                        <h3 class="font-bold">{{ count($errors) }} error(s) found</h3>
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

                <!-- Name -->
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text sm:text-base">Full Name</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $user->name) }}"
                        placeholder="Your full name"
                        class="input input-bordered w-full sm:text-base focus:input-primary @error('name') input-error @enderror" />
                    @error('name')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text sm:text-base">Email Address</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}"
                        placeholder="your@email.com"
                        class="input input-bordered w-full sm:text-base focus:input-primary @error('email') input-error @enderror" />
                    <span class="text-xs text-base-content/60 mt-2">Used for login and notifications</span>
                    @error('email')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Current Avatar -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text sm:text-base">Current Avatar</span>
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
                        <span class="text-xs sm text-base-content/60">Click below to change avatar</span>
                    </div>
                </div>

                <!-- Avatar Upload -->
                <div class="form-control">
                    <label class="label" for="avatar">
                        <span class="label-text sm:text-base">Upload New Avatar</span>
                    </label>
                    <input 
                        type="file" 
                        id="avatar" 
                        name="avatar" 
                        accept="image/*"
                        class="file-input file-input-bordered w-full focus:file-input-primary @error('avatar') file-input-error @enderror" />
                    <span class="text-xs text-base-content/60 mt-2">Max 2MB, formats: JPG, PNG, GIF</span>
                    @error('avatar')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="form-control">
                    <label class="label" for="bio">
                        <span class="label-text sm:text-base">Bio</span>
                    </label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="4"
                        placeholder="Tell us about yourself..."
                        class="textarea textarea-bordered sm:text-base focus:textarea-primary @error('bio') textarea-error @enderror">{{ old('bio', $user->bio) }}</textarea>
                    <span class="text-xs text-base-content/60 mt-2">Max 500 characters</span>
                    @error('bio')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="divider">Change Password (Optional)</div>

                <!-- Current Password -->
                <div class="form-control">
                    <label class="label" for="current_password">
                        <span class="label-text sm:text-base">Current Password</span>
                    </label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        placeholder="Enter your current password"
                        class="input input-bordered w-full sm:text-base focus:input-primary @error('current_password') input-error @enderror" />
                    <span class="text-xs text-base-content/60 mt-2">Required if changing password</span>
                    @error('current_password')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text sm:text-base">New Password</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter new password (min 8 characters)"
                        class="input input-bordered w-full sm:text-base focus:input-primary @error('password') input-error @enderror" />
                    <span class="text-xs text-base-content/60 mt-2">Leave blank to keep current password</span>
                    @error('password')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-control">
                    <label class="label" for="password_confirmation">
                        <span class="label-text sm:text-base">Confirm New Password</span>
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Confirm new password"
                        class="input input-bordered w-full sm:text-base focus:input-primary @error('password_confirmation') input-error @enderror" />
                    @error('password_confirmation')
                        <span class="text-error text-xs sm mt-1">{{ $message }}</span>
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
