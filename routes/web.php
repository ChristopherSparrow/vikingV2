<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FrameController;


Route::get('/', [SeasonController::class, 'viking'])->name('viking');



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

Route::get('seasons/{season}/players/create', [PlayerController::class, 'create'])->name('seasons.players.create');

Route::post('seasons/{season}/players', [PlayerController::class, 'store'])->name('players.store');
// Route to show the form to edit an existing player
Route::get('seasons/{season}/players/{player}/edit', [PlayerController::class, 'edit'])->name('seasons.players.edit');
Route::delete('/seasons/{season}/teams/{team}', [TeamController::class, 'destroy'])->name('seasons.teams.destroy');

Route::resource('games', GameController::class);
Route::get('mostwins/{competition}', [GameController::class, 'mostwins'])->name('games.mostwins');
Route::get('totalclearances/{competition}', [GameController::class, 'totalclearances'])->name('games.totalclearances');


Route::get('competitions/{competition}/games', [GameController::class, 'gamesByCompetition'])->name('competitions.games');


Route::resource('frames', FrameController::class);

Route::get('frames/{frame}/edit', [FrameController::class, 'edit'])->name('frames.edit');

Route::put('frames/{frame}', [FrameController::class, 'update'])->name('frames.update');
Route::get('/games/create/{season_id}/{competition_id}', [GameController::class, 'create'])->name('games.create');