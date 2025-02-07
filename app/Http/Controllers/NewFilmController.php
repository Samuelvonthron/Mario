<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function show($filmId)
    {

        return view('film.newfilm', compact('film'));
    }
}