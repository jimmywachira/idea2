<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class IdeaController extends Controller
{
    # Display a listing of the resource.
    public function index(Request $request){
        $user = Auth::user();
        $status = request('status');
        $search = request('search');

        $ideas = $user->ideas()
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest('created_at')
            ->paginate(12)
            ->appends(request()->query());

        return view('ideas.index', ['ideas' => $ideas, 'status' => $status, 'search' => $search]);
    }

   #Show the form for creating a new resource.
    public function create(): void{
        
    }

    #Store a newly created resource in storage.
    public function store(StoreIdeaRequest $request): \Illuminate\Http\RedirectResponse
    {
        
        $validated = $request->validated();

        $user = Auth::user();

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
        return redirect()->route('ideas.index')->with('success', 'Idea created successfully!');
    }

    #Display the specified resource.
    public function show(Idea $idea){
        return view('ideas.show', ['idea' => $idea]);
    }

    #Show the form for editing the specified resource.
    public function edit(Idea $idea): void
    {
        //
    }

    #Update the specified resource in storage.
    public function update(UpdateIdeaRequest $request, Idea $idea): \Illuminate\Http\RedirectResponse 
    {
        $validated = $request->validated();

        $idea->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'links' => $validated['links'] ?? [],
            'image_path' => $validated['image_path'] ?? null,
        ]);

        // Sync steps: Delete existing and recreate
        $idea->steps()->delete();
        if (!empty($validated['steps'])) {
            foreach ($validated['steps'] as $stepDescription) {
                $idea->steps()->create([
                    'description' => $stepDescription,
                    'completed' => false,
                ]);
            }
        }

        return redirect()->route('ideas.show', $idea)->with('success', 'Idea updated successfully!');
    }

    #Remove the specified resource from storage.
    public function destroy(Idea $idea): \Illuminate\Http\RedirectResponse 
    {
        #$this->authorize('delete', $idea);
        $idea->delete();
        return redirect()->route('ideas.index')->with('success', 'Idea deleted successfully.');
    }
}
