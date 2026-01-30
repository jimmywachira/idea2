<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function toggle(Idea $idea): RedirectResponse
    {
        $userId = auth()->id();
        $like = $idea->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            $message = 'Like removed!';
        } else {
            $idea->likes()->create([
                'user_id' => $userId,
            ]);
            $message = 'Idea liked!';
        }

        return redirect()->back()->with('success', $message);
    }
}
