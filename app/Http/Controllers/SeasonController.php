<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the seasons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // Remove the type declaration from here
    {
        $seasons = Season::all(); // Fetch all seasons from the database
        return view('seasons.index', compact('seasons')); // Pass seasons to the view
    }

    public function create()
    {
        return view('seasons.create'); // Return the create season form view
    }
}
