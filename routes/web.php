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
    return view('auth.login_staff');
});
Route::post('/login_staff', [ApiController::class, 'login'])->name('login_staff');



Route::get('/film', [ApiController::class, 'getFilms'])->name('film');


Route::get('/details/{id}', [ApiController::class, 'getFilmDetails'])->name('detail');
Route::get('/details/{id}', [ApiController::class, 'showFilmDetail'])->name('film.details');

Route::get('/film/{id}', [ApiController::class, 'showNewFilm'])->name('film.show');
Route::get('/film/create', [ApiController::class, 'createNewFilm'])->name('film.create');
Route::post('/film', [ApiController::class, 'storeNewFilm'])->name('film.store');


Route::get('/details/{id}', [ApiController::class, 'showFilmDetail'])->name('film.details');

Route::get('/edit/{id}', [ApiController::class, 'getFilmEdit'])->name('edit');
Route::get('/edit/{id}', [ApiController::class, 'showFilmEdit'])->name('film.edit');
Route::put('/edit/{id}', [ApiController::class, 'update'])->name('film.update');

Route::get('/filmedit/{id}', [ApiController::class, 'showFilmEdit'])->name('filmedit');

Route::get('/film/delete/{id}', [ApiController::class, 'showDeletePage'])->name('film.delete');
Route::get('/film/delete/{id}', [ApiController::class, 'deleteFilm'])->name('film.delete');

Route::get('/films', [ApiController::class, 'getFilms'])->name('film.index');

Route::get('/inventaire/{filmId}', [ApiController::class, 'afficherInventaire'])->name('film.inventaire');

Route::post('/inventaire/update', [ApiController::class, 'updateIventory'])->name('inventaire.update');