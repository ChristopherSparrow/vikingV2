<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use App\Models\Game;
use App\Models\Season;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display the specified competition.
     */
    public function show(Competition $competition)
    {
        $teams = null;
        $games = null;
        $players = null;

        if (in_array($competition->type, ['league', 'team_knockout'])) {
            $teams = $competition->season->teams; // Fetch teams from the associated season
            $games = Game::where('competition_id', $competition->id)->get()->groupBy('date');
        } elseif ($competition->type == 'singles') {
            $games = Game::where('competition_id', $competition->id)->get()->groupBy('date');
            $players = $competition->season->players; // Fetch players from the associated season
        }

        return view('competitions.show', compact('competition', 'teams', 'games', 'players'));
    }

    public function create()
    {
        $seasons = Season::all();
        $competitions = Competition::all();
        $teams = Team::all();
    
        return view('games.create', compact('seasons', 'competitions', 'teams'));
    }

    public function getCompetitionsBySeason($season_id)
{
    $competitions = Competition::where('season_id', $season_id)->get();
    return response()->json($competitions);
}

}
