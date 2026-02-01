<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Idea;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(): View
    {
        $teams = auth()->user()->teams()->latest('created_at')->get();
        $ownedTeams = Team::where('created_by', auth()->id())->get();

        return view('teams.index', compact('teams', 'ownedTeams'));
    }

    public function create(): View
    {
        return view('teams.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $team = Team::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        // Add creator as owner
        $team->users()->attach(auth()->id(), ['role' => 'owner']);

        return redirect()->route('teams.show', $team)->with('success', 'Team created successfully!');
    }

    public function show(Team $team): View
    {
        $this->authorize('view', $team);

        $ideas = $team->ideas()->latest('created_at')->get();
        $members = $team->users()->get();

        return view('teams.show', compact('team', 'ideas', 'members'));
    }

    public function edit(Team $team): View
    {
        $this->authorize('update', $team);

        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team): RedirectResponse
    {
        $this->authorize('update', $team);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $team->update($validated);

        return redirect()->route('teams.show', $team)->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team): RedirectResponse
    {
        $this->authorize('delete', $team);

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }

    public function addMember(Request $request, Team $team): RedirectResponse
    {
        $this->authorize('update', $team);

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        if ($team->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User is already a member of this team.');
        }

        $team->users()->attach($user->id, ['role' => 'member']);

        return back()->with('success', "{$user->name} added to the team!");
    }

    public function removeMember(Team $team, User $user): RedirectResponse
    {
        $this->authorize('update', $team);

        if ($team->isOwner($user)) {
            return back()->with('error', 'Cannot remove the team owner.');
        }

        $team->users()->detach($user->id);

        return back()->with('success', "{$user->name} removed from the team!");
    }

    public function shareIdea(Request $request, Team $team, Idea $idea): RedirectResponse
    {
        $this->authorize('update', $team);

        if ($idea->user_id !== auth()->id()) {
            return back()->with('error', 'You can only share your own ideas.');
        }

        $idea->update(['team_id' => $team->id]);

        return back()->with('success', 'Idea shared with the team!');
    }

    public function unshareIdea(Team $team, Idea $idea): RedirectResponse
    {
        $this->authorize('update', $team);

        if ($idea->user_id !== auth()->id()) {
            return back()->with('error', 'You can only unshare your own ideas.');
        }

        $idea->update(['team_id' => null]);

        return back()->with('success', 'Idea removed from the team!');
    }
}
