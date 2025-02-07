<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ApiController extends Controller
{
    public function getFilms()
    {
        $apiurl = 'http://localhost:8080/toad/film/all';
        
        // Utilisation de file_get_contents pour récupérer les données
        $response = file_get_contents($apiurl);

        // Vérification si la requête a réussi et décodage du JSON
        if ($response !== false) {
            $films = json_decode($response, true); // Décoder la réponse JSON

            // Retourner la vue avec les données des films
            return view('film', compact('films'));
        }

        // Gestion d'erreur si l'appel échoue
        return response()->json(['error' => 'Impossible de récupérer les films'], 500);
    }

    public function getFilmDetails()
{
    $baseApiUrl = 'http://localhost:8080/toad/film';
    
        // Étape 1 : Récupérer la liste de tous les films pour obtenir les `id`
        $allFilmsResponse = file_get_contents("{$baseApiUrl}/all");

        if (!$allFilmsResponse) {
            return redirect()->route('home')->with('error', 'Impossible de récupérer la liste des films.');
        }

        // Décodage de la réponse JSON
        $allFilms = json_decode($allFilmsResponse, true);

        if (empty($allFilms)) {
            return redirect()->route('home')->with('error', 'Aucun film trouvé.');
        }

        $detailedFilms = [];

        // Étape 2 : Parcourir chaque `id` et récupérer les détails
        foreach ($allFilms as $film) {
            if (isset($film['id'])) {
                $id = $film['id'];
                $detailsResponse = file_get_contents("{$baseApiUrl}/getById?id={$id}");

                if ($detailsResponse) {
                    $filmDetails = json_decode($detailsResponse, true);
                    $detailedFilms[] = $filmDetails;
                } else {
            }
        }

        // Étape 3 : Passer les films détaillés à la vue
        return view('detail', ['films' => $detailedFilms]);

        }
    }

    public function showFilmDetail($id)
    {
        $apiUrl = "http://localhost:8080/toad/film/getById?id={$id}";
    
        // Utiliser file_get_contents avec un contexte de gestion d'erreur
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true, // Ignorer les erreurs HTTP
            ],
        ]);
    
        // Récupérer la réponse de l'API
        $response = file_get_contents($apiUrl, false, $context);
    
        // Décoder la réponse JSON
        $film = json_decode($response, true);
    
        return view('detail', ['id' => $id, 'film' => $film]);
    }




    public function getFilmEdit()
{
    $baseApiUrl = 'http://localhost:8080/toad/film';
    
        // Étape 1 : Récupérer la liste de tous les films pour obtenir les `id`
        $allFilmsResponse = file_get_contents("{$baseApiUrl}/all");

        if (!$allFilmsResponse) {
            return redirect()->route('home')->with('error', 'Impossible de récupérer la liste des films.');
        }

        // Décodage de la réponse JSON
        $allFilms = json_decode($allFilmsResponse, true);

        if (empty($allFilms)) {
            return redirect()->route('home')->with('error', 'Aucun film trouvé.');
        }

        $EditFilms = [];

        // Étape 2 : Parcourir chaque `id` et récupérer les détails
        foreach ($allFilms as $film) {
            if (isset($film['id'])) {
                $id = $film['id'];
                $EditResponse = file_get_contents("{$baseApiUrl}/getById?id={$id}");

                if ($EditResponse) {
                    $filmEdit = json_decode($EditResponse, true);
                    $EditFilms[] = $filmEdit;
                } else {
            }
        }

        // Étape 3 : Passer les films détaillés à la vue
        return view('id', ['filmedit' => $EditFilms]);

        }
    }

    public function showFilmEdit($id)
    {
        // Appel API pour récupérer les infos du film
        $response = Http::get("http://localhost:8080/toad/film/getById?id={$id}");

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Impossible de récupérer les données du film.');
        }

        $film = $response->json();
        return view('filmedit', compact('film'));
    }

    public function update(Request $request, $id)
    {
        Log::info("Requête reçue pour mise à jour du film ID: " . $id, $request->all());

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'disponibilite' => 'required|boolean',
            'client' => 'nullable|string|max:255',
            'lieu_stockage' => 'nullable|string|max:255',
            'date_emprunt' => 'nullable|date',
            'date_rendu' => 'nullable|date',
            'description' => 'nullable|string',
            'etat' => 'nullable|string',
        ]);

        $response = Http::put("http://localhost:8080/toad/film/update/{$id}", $validatedData);

        if ($response->failed()) {
            Log::error("Échec de mise à jour du film ID: " . $id, ['response' => $response->body()]);
            return redirect()->back()->with('error', 'La mise à jour a échoué.');
        }

        Log::info("Mise à jour réussie pour le film ID: " . $id);
        return redirect()->route('filmedit', $id)->with('success', 'Film mis à jour avec succès.');
    }
}


    