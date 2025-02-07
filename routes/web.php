<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RecoverController;
use App\Http\Controllers\NewFilmController;
use App\Http\Controllers\FilmController;
use Spatie\FlareClient\Api;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/film', function () {
    return view('film');
})->middleware(['auth', 'verified'])->name('film');

Route::get('/film', [ApiController::class, 'getFilms'])->name('film');

Route::get('/detail', function () {
    return view('detail');
})->middleware(['auth', 'verified'])->name('detail');

Route::get('/details/{id}', [ApiController::class, 'getFilmDetails'])->name('detail');
Route::get('/details/{id}', [ApiController::class, 'showFilmDetail'])->name('film.details');

Route::get('/film/{id}', [NewFilmController::class, 'show'])->name('film.show');

Route::get('/detail', function () {
    return view('detail');
})->middleware(['auth', 'verified'])->name('detail');

Route::get('/edit/{id}', [ApiController::class, 'getFilmEdit'])->name('edit');
Route::get('/edit/{id}', [ApiController::class, 'showFilmEdit'])->name('film.edit');
Route::put('/edit/{id}', [ApiController::class, 'update'])->name('film.update');

require __DIR__.'/auth.php';
