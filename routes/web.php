<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;


Route::get('/', function () {
    return view('viking');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('competitions/{competition}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/seasons/{season}/teams', [SeasonController::class, 'showTeams'])->name('seasons.teams');
Route::get('/seasons/{season}/players', [SeasonController::class, 'showPlayers'])->name('seasons.players');
