<?php

namespace App\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idea;
use App\Models\Step;
use App\IdeaStatus;
use App\Models\User;

class Createidea
{
    public function handle(array $attributes, Request $request,User $user=null): void
    {
        $validated = $request->validated();

        $user ??= Auth::user();

        $idea = $user->ideas()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            #'steps' => $validated['steps'] ?? [],
            #'image_path' => $validated['image_path'] ?? null,
            'links' => $validated['links'] ?? []
        ]);

        // Create related steps if provided
        if (!empty($validated['steps'])) {
            foreach ($validated['steps'] as $stepDescription) {
                $idea->steps()->create([
                    'description' => $stepDescription,
                    'completed' => false,
                ]);
            }
        }

        if ($request->hasFile('image_path')) {
            // Stores in storage/app/public/ideas and returns the path "ideas/filename.jpg"
            $path = $request->file('image_path')->store('ideas', 'public');

            // Save the relative path on the idea (assumes 'image_path' column exists)
            $idea->update(['image_path' => $path]);
        }

        #dd($request->all(), $request->file('image_path'));
    }
}