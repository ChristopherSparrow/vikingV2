<?php


namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Season;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the players.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new player.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Season $season)
    {
        $teams = $season->teams; // Fetch teams associated with the season
        return view('players.create', compact('season', 'teams'));
    }

    /**
     * Store a newly created player in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'team_id' => 'required|integer|exists:teams,id',
        ]);

        Player::create($request->all());

        return redirect()->route('seasons.index')
                         ->with('success', 'Player created successfully.');
    }

    /**
     * Display the specified player.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified player.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    /**
     * Update the specified player in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Player $player)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'team' => 'required|string|max:255',
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')
                         ->with('success', 'Player updated successfully.');
    }

    /**
     * Remove the specified player from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')
                         ->with('success', 'Player deleted successfully.');
    }
}