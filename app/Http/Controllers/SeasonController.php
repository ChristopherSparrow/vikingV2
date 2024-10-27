<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the seasons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Contracts\View\View // Add the type declaration here
    {
        $seasons = Season::all(); // Fetch all seasons from the database
        return view('seasons.index', compact('seasons')); // Pass seasons to the view
    }

    public function showTeams(Season $season)
    {
        // Get all teams associated with the season
        $teams = $season->teams;
    
        // Pass the season and its teams to the view
        return view('seasons.showTeams', compact('season', 'teams'));
    }
    
    public function showPlayers(Season $season)
    {
        // Get all teams with their players for the season
        $teams = $season->teams()->with('players')->get();
    
        // Pass the season and its teams (with players) to the view
        return view('seasons.showPlayers', compact('season', 'teams'));
    }
}
