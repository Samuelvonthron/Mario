<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;


Route::get('/toad/film/all', 'FilmController@index');
Route::post('/toad/film/add', 'FilmController@store');
Route::get('/toad/film//update/{id}', 'FilmController@show');
Route::delete('/toad/film/delete/{id}', 'FilmController@destroy');