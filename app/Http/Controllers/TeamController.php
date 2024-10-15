<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Season;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the seasons.
     *
     * @return \Illuminate\Http\Response
     */
public function edit(Season $season, Team $team)
{
    // Pass the season and team to the view for editing
    return view('teams.edit', compact('season', 'team'));
}

public function update(Request $request, Season $season, Team $team)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'other_field' => 'required|string', // Add any other fields you want to edit
    ]);

    // Update the team's details
    $team->update($request->all());

    // Redirect back to the list of teams for the season
    return redirect()->route('seasons.teams', $season->id)
                     ->with('success', 'Team details updated successfully!');
}
public function create(Season $season)
    {
        return view('teams.create', compact('season'));
    }

    // Store the newly created team in the database
    public function store(Request $request, Season $season)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'other_field' => 'required|string'  // Add more validation rules as needed
        ]);

        // Create a new team and associate it with the current season
        $season->teams()->create($request->all());

        // Redirect back to the list of teams for the season with a success message
        return redirect()->route('seasons.teams', $season->id)
                         ->with('success', 'Team added successfully!');
    }
    
}