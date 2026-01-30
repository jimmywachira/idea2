<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Idea $idea): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $idea->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        return redirect()->route('ideas.show', $idea)->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $ideaId = $comment->idea_id;

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('ideas.show', $ideaId)->with('success', 'Comment deleted successfully!');
    }
}
