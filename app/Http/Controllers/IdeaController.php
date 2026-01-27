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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = request('status'); 

        // if (! in_array($status, ['Pending', 'InProgress', 'Completed'])) {
        //     $status = null;
        // }

        $ideas = $user->ideas()
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })->latest('created_at')->get();

        return view('ideas.index', ['ideas' => $ideas, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        
        Auth::user()->ideas()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            #'image' => $validated['image'] ?? null,
            'links' => $validated['links'] ?? []
        ]);
        
        return redirect()->route('ideas.index')->with('success', 'Idea created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('ideas.show', ['idea' => $idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea): \Illuminate\Http\RedirectResponse
    {
        #$this->authorize('delete', $idea);
        $idea->delete();
        return redirect()->route('ideas.index')->with('success', 'Idea deleted successfully.');
    }
}
