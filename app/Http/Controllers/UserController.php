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
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = auth()->user();

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
