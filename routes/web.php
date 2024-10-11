<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
