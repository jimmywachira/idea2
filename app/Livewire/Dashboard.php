<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Idea;

class Dashboard extends Component
{
    public $activeSection = 'ideas';
    
    public function render()
    {
        $teams = auth()->user()->teams()->latest('created_at')->get();
        $ideas = auth()->user()->ideas()->latest('created_at')->get();
        $user = auth()->user();
        $teamIdeas = Idea::whereIn('team_id', $teams->pluck('id'))->get();

        return view('livewire.dashboard', [
            'teams' => $teams,
            'ideas' => $ideas,
            'user' => $user,
            'teamIdeas' => $teamIdeas,
        ])->layout('layouts.dashboard', ['title' => 'Dashboard']);
    }

    public function setActiveSection($section)
    {
        $this->activeSection = $section;
    }
}
