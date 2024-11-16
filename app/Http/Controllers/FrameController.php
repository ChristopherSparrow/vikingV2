<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\Game;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class FrameController extends Controller
{
    /**
     * Display a listing of the frames.
     */
    public function index()
    {
        $frames = Frame::all();
        return view('frames.index', compact('frames'));
    }

    /**
     * Show the form for creating a new frame.
     */
    public function create()
    {
        return view('frames.create');
    }

    /**
     * Store a newly created frame in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'home_player_id' => 'required|exists:players,id',
            'away_player_id' => 'required|exists:players,id',
            'frame_number' => 'required|integer|min:1|max:12',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
            'HomeFirst' => 'nullable|boolean',
            'AwayFirst' => 'nullable|boolean',
            'Home8' => 'nullable|boolean',
            'Away8' => 'nullable|boolean',
        ]);

        $game = Game::findOrFail($validatedData['game_id']);
  // Check if the home player belongs to the home team
  if (!$game->homeTeam->players->contains($validatedData['home_player_id'])) {
    return redirect()->back()->withErrors(['home_player_id' => 'The selected home player does not belong to the home team.'])->withInput();
}

// Check if the away player belongs to the away team
if (!$game->awayTeam->players->contains($validatedData['away_player_id'])) {
    return redirect()->back()->withErrors(['away_player_id' => 'The selected away player does not belong to the away team.'])->withInput();
}

        // Set default values for checkboxes if they are not present in the request
        $validatedData['HomeFirst'] = $request->has('HomeFirst') ? $request->HomeFirst : null;
        $validatedData['AwayFirst'] = $request->has('AwayFirst') ? $request->AwayFirst : null;
        $validatedData['Home8'] = $request->has('Home8') ? $request->Home8 : null;
        $validatedData['Away8'] = $request->has('Away8') ? $request->Away8 : null;

        $frame = Frame::create($validatedData);
        return redirect()->route('games.show', $frame->game_id);
    }

    /**
     * Display the specified frame.
     */
    public function show(Frame $frame)
    {
        return view('frames.show', compact('frame'));
    }

    /**
     * Show the form for editing the specified frame.
     */
    
    
     public function edit(Frame $frame)
     {
         $homeTeamPlayers = $frame->game->homeTeam->players;
         $awayTeamPlayers = $frame->game->awayTeam->players;
         $teams = Team::all();
         return view('frames.edit', compact('frame', 'homeTeamPlayers', 'awayTeamPlayers', 'teams'));
     }

    /**
     * Update the specified frame in storage.
     */
  
     public function update(Request $request, Frame $frame)
     {
        try {
             // Convert checkbox values to boolean
             $request->merge([
                 'HomeFirst' => $request->input('HomeFirst', false),
                 'Home8' => $request->input('Home8', false),
                 'AwayFirst' => $request->input('AwayFirst', false),
                 'Away8' => $request->input('Away8', false),
             ]);
 
             // Validate the request data
             $validatedData = $request->validate([
                 'home_player_id' => 'required|exists:players,id',
                 'away_player_id' => 'required|exists:players,id',
                 'home_score' => 'required|integer',
                 'away_score' => 'required|integer',
                 'HomeFirst' => 'required|boolean',
                 'Home8' => 'required|boolean',
                 'AwayFirst' => 'required|boolean',
                 'Away8' => 'required|boolean',
             ]);
 
             $game = $frame->game;

             // Check if the home player belongs to the home team
             if (!$game->homeTeam->players->contains($validatedData['home_player_id'])) {
                 return redirect()->back()->withErrors(['home_player_id' => 'The selected home player does not belong to the home team.'])->withInput();
             }
     
             // Check if the away player belongs to the away team
             if (!$game->awayTeam->players->contains($validatedData['away_player_id'])) {
                 return redirect()->back()->withErrors(['away_player_id' => 'The selected away player does not belong to the away team.'])->withInput();
             }
             // Update the frame with the validated data
             $frame->home_player_id = $validatedData['home_player_id'];
             $frame->away_player_id = $validatedData['away_player_id'];
             $frame->home_score = $validatedData['home_score'];
             $frame->away_score = $validatedData['away_score'];
             $frame->HomeFirst = $validatedData['HomeFirst'];
             $frame->Home8 = $validatedData['Home8'];
             $frame->AwayFirst = $validatedData['AwayFirst'];
             $frame->Away8 = $validatedData['Away8'];
 
             $frame->save();
 
             // Redirect back to the games.show view
             return redirect()->route('games.show', $frame->game_id)->with('success', 'Frame updated successfully.');
 
         } catch (ValidationException $e) {

             return redirect()->back()->withErrors($e->errors())->withInput();
         } catch (\Exception $e) {

             return redirect()->back()->with('error', 'An error occurred while updating the frame.')->withInput();
         }
     }

    /**
     * Remove the specified frame from storage.
     */
    public function destroy(Frame $frame)
    {
        $frame->delete();
        return redirect()->route('frames.index');
    }
}