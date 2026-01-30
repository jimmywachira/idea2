<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Idea;
use App\Models\Comment;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function __construct()
    {
        #$this->middleware('auth');
        #$this->middleware('admin');
    }

    public function dashboard(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_ideas' => Idea::count(),
            'total_comments' => Comment::count(),
            'banned_users' => User::where('is_banned', true)->count(),
            'pending_flags' => \DB::table('moderation_flags')->where('status', 'pending')->count(),
        ];

        $recent_ideas = Idea::latest()->with('user')->limit(5)->get();
        $recent_comments = Comment::latest()->with('user', 'idea')->limit(5)->get();
        $pending_flags = \DB::table('moderation_flags')
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_ideas', 'recent_comments', 'pending_flags'));
    }

    public function users(): View
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function changeUserRole(User $user): RedirectResponse
    {
        $current_role = $user->role;
        
        $new_role = match ($current_role) {
            UserRole::User => UserRole::Moderator,
            UserRole::Moderator => UserRole::Admin,
            UserRole::Admin => UserRole::User,
        };

        $user->update(['role' => $new_role]);

        return back()->with('success', "User role changed from {$current_role->label()} to {$new_role->label()}");
    }

    public function banUser(User $user): RedirectResponse
    {
        if ($user->isAdmin() && auth()->user()->id !== $user->id) {
            return back()->with('error', 'Cannot ban other administrators');
        }

        $user->ban();
        return back()->with('success', 'User has been banned');
    }

    public function unbanUser(User $user): RedirectResponse
    {
        $user->unban();
        return back()->with('success', 'User has been unbanned');
    }

    public function ideas(): View
    {
        $ideas = Idea::with('user')->latest()->paginate(15);
        return view('admin.ideas.index', compact('ideas'));
    }

    public function deleteIdea(Idea $idea): RedirectResponse
    {
        $idea->delete();
        return back()->with('success', 'Idea has been deleted');
    }

    public function comments(): View
    {
        $comments = Comment::with('user', 'idea')->latest()->paginate(15);
        return view('admin.comments.index', compact('comments'));
    }

    public function deleteComment(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return back()->with('success', 'Comment has been deleted');
    }

    public function flags(): View
    {
        $flags = \DB::table('moderation_flags')
            ->leftJoin('users', 'moderation_flags.flagged_by', '=', 'users.id')
            ->select('moderation_flags.*', 'users.name as flagged_by_name')
            ->latest('moderation_flags.created_at')
            ->paginate(15);
        
        return view('admin.flags.index', compact('flags'));
    }

    public function resolveFlag($flag_id): RedirectResponse
    {
        \DB::table('moderation_flags')
            ->where('id', $flag_id)
            ->update([
                'status' => 'resolved',
                'reviewed_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Flag has been resolved');
    }

    public function dismissFlag($flag_id): RedirectResponse
    {
        \DB::table('moderation_flags')
            ->where('id', $flag_id)
            ->update([
                'status' => 'dismissed',
                'reviewed_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Flag has been dismissed');
    }
}
