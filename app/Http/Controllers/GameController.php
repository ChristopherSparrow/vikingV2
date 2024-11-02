<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Frame;
use App\Models\Team;
use App\Models\Season;
use App\Models\Competition;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the games.
     */
    public function index()
    {
        $games = Game::all()->groupBy('date');
    return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new game.
     */
    public function create()
    {
        $teams = Team::all();
        $seasons = Season::all();
        $competitions = Competition::all();
        return view('games.create', compact('teams', 'seasons', 'competitions'));
    }

    /**
     * Store a newly created game in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'competition_id' => 'required|exists:competitions,id',
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'date' => 'required|date',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
        ]);

        Game::create($request->all());

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified game.
     */
    public function show(Game $game)
    {
        $frames = Frame::where('game_id', $game->id)->orderBy('frame_number')->get();
        return view('games.show', compact('game', 'frames'));
    }

    public function mostwins(Competition $competition)
    {
        $frames = Frame::whereHas('game', function ($query) use ($competition) {
            $query->where('competition_id', $competition->id);
        })->orderBy('game_id')->orderBy('frame_number')->get();
        
        return view('competitions.mostwins', compact('frames'));
    }

    /**
     * Show the form for editing the specified game.
     */
    public function edit(Game $game)
    {
        $teams = Team::all();
        $seasons = Season::all();
        $competitions = Competition::all();
        return view('games.edit', compact('game', 'teams', 'seasons', 'competitions'));
    }

    /**
     * Update the specified game in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'competition_id' => 'required|exists:competitions,id',
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'date' => 'required|date',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
        ]);

        $game->update($request->all());

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified game from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }


    public function gamesByCompetition(Competition $competition)
    {
        $games = Game::where('competition_id', $competition->id)->get()->groupBy('date');
        return view('competions.index', compact('games', 'competition'));
    }
}