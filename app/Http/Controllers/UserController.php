<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user): View
    {
        $ideas = $user->ideas()->latest('created_at')->get();
        $ideaCount = $user->ideas()->count();
        $completedCount = $user->ideas()->where('status', 'completed')->count();

        return view('profiles.show', compact('user', 'ideas', 'ideaCount', 'completedCount'));
    }

    public function edit(): View
    {
        return view('profiles.edit', ['user' => auth()->user()]);
    }

    public function update(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    { 
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        // Validate current password if changing password
        if ($request->filled('password')) {
            if (!$request->filled('current_password')) {
                return back()->withErrors(['current_password' => 'Current password is required to change password.']);
            }

            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        // Remove current_password and empty password from update
        unset($validated['current_password']);
        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar_path && \Storage::exists($user->avatar_path)) {
                \Storage::delete($user->avatar_path);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar_path'] = $path;
        }

        $user->update($validated);

        return redirect()->route('profiles.show', $user)->with('success', 'Profile updated successfully!');
    }
}
