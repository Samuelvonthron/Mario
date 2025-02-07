<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index',[

            'chirps' => chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =$request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->chirps()->create($validated);

        return redirect()->route('chirps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
       /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        // retourner la view
        $this->authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        // Contrôler les données
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        // Update
        $chirp->update($validated);
        //Rediriger
        return redirect(route('chirps.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        // contrôle autorisation pour delete
        $this->authorize('delete', $chirp);
        // delete
        $chirp->delete();
        // Rediriger
        return redirect(route('chirps.index'));
    }

}
