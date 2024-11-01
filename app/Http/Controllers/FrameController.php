<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use Illuminate\Http\Request;

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
        ]);

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
        return view('frames.edit', compact('frame'));
    }

    /**
     * Update the specified frame in storage.
     */
    public function update(Request $request, Frame $frame)
    {
        $validatedData = $request->validate([
            'game_id' => 'required|exists:games,id',
            'home_player_id' => 'required|exists:players,id',
            'away_player_id' => 'required|exists:players,id',
            'frame_number' => 'required|integer|min:1|max:12',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
        ]);

        $frame->update($validatedData);
        return redirect()->route('frames.index');
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