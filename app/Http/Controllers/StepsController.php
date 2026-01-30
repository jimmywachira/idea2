<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    public function update(Step $step, Request $request)
    {
        #authentication and validation logic here
        $step->update([
            'completed' => ! $step->completed
        ]);
        
        return back();
    }
}


