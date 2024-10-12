<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display the specified competition.
     */
    public function show(Competition $competition)
    {

        $teams = null;
        if (in_array($competition->type, ['league', 'team_knockout'])) {
            $teams = $competition->season->teams; // Fetch teams from the associated season
        }

        return view('competitions.show', compact('competition', 'teams'));
    }
}
