<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use App\Models\Game;
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

        $games = Game::where('competition_id', $competition->id)->get()->groupBy('date');

        return view('competitions.show', compact('competition', 'teams', 'games'));
    }
}
