<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TeamController;


Route::get('/', function () {
    return view('viking');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('competitions/{competition}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/seasons/{season}/teams', [SeasonController::class, 'showTeams'])->name('seasons.teams');
Route::get('/seasons/{season}/players', [SeasonController::class, 'showPlayers'])->name('seasons.players');
Route::get('/seasons/{season}/teams/{team}/edit', [TeamController::class, 'edit'])->name('seasons.teams.edit');
Route::put('/seasons/{season}/teams/{team}', [TeamController::class, 'update'])->name('seasons.teams.update');
Route::get('/seasons/{season}/teams/create', [TeamController::class, 'create'])->name('seasons.teams.create');

// Route to store the new team in the database
Route::post('/seasons/{season}/teams', [TeamController::class, 'store'])->name('seasons.teams.store');