<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class RecoverController extends Controller{

    public function update(Request $request)
    {
        $request->validate([
            'mdp' => 'required|min:12',
            'mdpverif' => 'required|same:mdp',
        ]);

        return redirect()->route('password.confirm');
    }

    public function confirm()
    {
        return view('confirmmdp'); 
    }

    public function index()
    {
        return view('pertesmdp'); 
    }
}