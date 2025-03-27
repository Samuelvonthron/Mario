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
    return redirect()->route('film');
})->middleware(['auth']);

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

Route::get('/film/{id}', [ApiController::class, 'showNewFilm'])->name('film.show');
Route::get('/film/create', [ApiController::class, 'createNewFilm'])->name('film.create');
Route::post('/film', [ApiController::class, 'storeNewFilm'])->name('film.store');

Route::get('/detail', function () {
    return view('detail');
})->middleware(['auth', 'verified'])->name('detail');

Route::get('/details/{id}', [ApiController::class, 'showFilmDetail'])->name('film.details');

Route::get('/edit/{id}', [ApiController::class, 'getFilmEdit'])->name('edit');
Route::get('/edit/{id}', [ApiController::class, 'showFilmEdit'])->name('film.edit');
Route::put('/edit/{id}', [ApiController::class, 'update'])->name('film.update');

Route::get('/filmedit/{id}', [ApiController::class, 'showFilmEdit'])->name('filmedit');

Route::get('/film/delete/{id}', [ApiController::class, 'showDeletePage'])->name('film.delete');
Route::get('/film/delete/{id}', [ApiController::class, 'deleteFilm'])->name('film.delete');

Route::get('/films', [ApiController::class, 'getFilms'])->name('film.index');

Route::get('/inventaire/{filmId}', [ApiController::class, 'afficherInventaire'])->name('film.inventaire');

require __DIR__.'/auth.php';
