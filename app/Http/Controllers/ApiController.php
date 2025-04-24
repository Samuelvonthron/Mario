<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ApiController extends Controller
{

    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL');
    }

    public function getFilms(Request $request)
{
    $search = $request->input('search');
    $filter = $request->input('filter');

    // Récupération des films depuis l'API
    $response = Http::get("{$this->apiBaseUrl}/film/all");

    if ($response->successful()) {
        $films = $response->json();

        // Appliquer la recherche si un mot-clé est entré
        if ($search) {
            $films = array_filter($films, function ($film) use ($search) {
                return stripos($film['title'], $search) !== false;
            });
        }

        // Appliquer les filtres si sélectionnés
        if ($filter) {
            $films = array_filter($films, function ($film) use ($filter, $search) {
                switch ($filter) {
                    case 'genre':
                        return isset($film['genre']) && stripos($film['genre'], $search) !== false;
                    case 'epoque':
                        return isset($film['releaseYear']) && stripos((string)$film['releaseYear'], $search) !== false;
                    case 'realisatrice':
                        return isset($film['director']) && stripos($film['director'], $search) !== false;
                    default:
                        return true;
                }
            });
        }

        // Retourner la vue avec les films filtrés
        return view('film', compact('films'));
    }

    return response()->json(['error' => 'Impossible de récupérer les films'], 500);
}

public function login(Request $request)
{
    $client = new \GuzzleHttp\Client();

    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $port = env('PORT');
    $serveur = env('SERVEUR');
    $email = $request->input('email');
    $password = $request->input('password');

    $apiUrl = "http://127.0.0.1:8080/toad/staff/getByEmail?email=" . urlencode($email);

    try {
        // Utilisation de Guzzle pour faire la requête GET
        $response = $client->request('GET', $apiUrl);

        // On décode la réponse JSON
        $staff = json_decode($response->getBody()->getContents(), true);

        if (!$staff) {
            return back()->with('error', 'Utilisateur non trouvé.');
        }

        // Vérification du mot de passe
        if ($staff['pasword'] !== $password) { 
            return back()->with('error', 'Mot de passe incorrect.');
        }

        // Stockage des informations de l'utilisateur en session
        session([
            'staff_id' => $staff['staffId'],
            'first_name' => $staff['firstName'],
            'last_name' => $staff['lastName'],
            'email' => $staff['email'],
            'store_id' => $staff['storeId'],
            'role_id' => $staff['roleId'],
            'is_logged_in' => true,
        ]);

        return redirect()->route('film')->with('success', 'Connexion réussie.');

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}


    public function getFilmDetails()
{
    $baseApiUrl =  Http::get("{$this->apiBaseUrl}/film");
    
        // Étape 1 : Récupérer la liste de tous les films pour obtenir les `id`

        if (!$baseApiUrl) {
            return redirect()->route('home')->with('error', 'Impossible de récupérer la liste des films.');
        }

        // Décodage de la réponse JSON
        $allFilms = $baseApiUrl->json();

        if (empty($allFilms)) {
            return redirect()->route('home')->with('error', 'Aucun film trouvé.');
        }

        $detailedFilms = [];

        // Étape 2 : Parcourir chaque `id` et récupérer les détails
        foreach ($allFilms as $film) {
            if (isset($film['id'])) {
                $id = $film['id'];

                if ($baseApiUrl) {
                    $filmDetails = $baseApiUrl->json();
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
        $apiUrl =  Http::get("{$this->apiBaseUrl}/film/getById?id={$id}");
    
        // Utiliser file_get_contents avec un contexte de gestion d'erreur
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true, // Ignorer les erreurs HTTP
            ],
        ]);
    
    
        // Décoder la réponse JSON
        $film = $apiUrl -> json();
    
        return view('detail', ['id' => $id, 'film' => $film]);
    }




    public function getFilmEdit()
{
    $baseApiUrl =  Http::get("{$this->apiBaseUrl}/film");
    
        // Étape 1 : Récupérer la liste de tous les films pour obtenir les `id`

        if (!$baseApiUrl) {
            return redirect()->route('home')->with('error', 'Impossible de récupérer la liste des films.');
        }

        // Décodage de la réponse JSON
        $allFilms = $baseApiUrl->json();

        if (empty($allFilms)) {
            return redirect()->route('home')->with('error', 'Aucun film trouvé.');
        }

        $EditFilms = [];

        // Étape 2 : Parcourir chaque `id` et récupérer les détails
        foreach ($allFilms as $film) {
            if (isset($film['id'])) {
                $id = $film['id'];

                if ($baseApiUrl) {
                    $filmEdit = $baseApiUrl->json();
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
        $response =  Http::get("{$this->apiBaseUrl}/film/getById?id={$id}");

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Impossible de récupérer les données du film.');
        }

        $film = $response->json();
        return view('filmedit', compact('film'));
    }

  /*  public function update(Request $request, $id)
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
}*/

public function update(Request $request, $id) {
    $apiUrl =  Http::get("{$this->apiBaseUrl}/film/update/{$id}");

    $queryParams = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'releaseYear' => $request->input('releaseYear'),
        'languageId' => $request->input('languageId', 1),
        'originalLanguageId' => $request->input('originalLanguageId', 1),
        'rentalDuration' => $request->input('rentalDuration'),
        'rentalRate' => $request->input('rentalRate'),
        'length' => $request->input('length', 0),
        'replacementCost' => $request->input('replacementCost', 0.0),
        'rating' => $request->input('rating', 'G'),
        'lastUpdate' => now()->format('Y-m-d H:i:s'),
        // 'idDirector' => $request->input('idDirector', 1),  // Commenté car pas utilisé dans l'API
    ];

    try {
        Log::info('Requête envoyée :', ['url' => $apiUrl, 'data' => $queryParams]);

        // Utilisation de `asForm()` pour envoyer les données en `x-www-form-urlencoded`
        $response = Http::asForm()->put($apiUrl, $queryParams);

        if ($response->successful()) {
            return redirect()->route('filmedit', $id)->with('success', 'Film mis à jour avec succès.');
        } else {
            Log::error('Erreur API:', ['status' => $response->status(), 'body' => $response->body()]);
            return redirect()->route('filmedit', $id)->with('error', 'Erreur lors de la mise à jour du film.');
        }
    } catch (\Exception $e) {
        Log::error('Exception lors de la mise à jour:', ['message' => $e->getMessage()]);
        return redirect()->route('filmedit', $id)->with('error', 'Erreur: ' . $e->getMessage());
    }
}

public function showNewFilm($filmId){
    {
        $film = [];
        return view('newfilm', compact('film'));
    }
    }

public function createNewFilm() {
        return view('newfilm'); // Vérifie que 'film_create.blade.php' existe
    }

    public function storeNewFilm(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Appel API pour enregistrer un nouveau film
        $response = Http::post(("{$this->apiBaseUrl}/film/store"), $validated);
    
        if ($response->successful()) {
            return redirect()->route('film.index')->with('success', 'Film ajouté avec succès');
        }
    
        return redirect()->back()->with('error', 'Erreur lors de l\'ajout du film');
    }

    public function showDeletePage($id)
{
    // Récupérer les détails du film à partir de l'API
    $response =  Http::get("{$this->apiBaseUrl}/film/{$id}");
    $film = $response->json();

    if (!$film) {
        return redirect()->route('films.index')->with('error', 'Film introuvable.');
    }

    return view('film.delete', compact('film'));
}

public function deleteMultipleFilms(Request $request)
{
    $filmIds = $request->input('film_ids');

    if (!$filmIds) {
        return back()->with('error', 'Aucun film sélectionné pour la suppression.');
    }

    try {
        foreach ($filmIds as $id) {
            Http::delete("{$this->apiBaseUrl}/film/delete?id={$id}");
        }

        return back()->with('success', 'Films supprimés avec succès.');
    } catch (\Exception $e) {
        Log::error('Erreur lors de la suppression des films', ['exception' => $e->getMessage()]);
        return back()->with('error', 'Erreur lors de la suppression des films.');
    }
}

public function deleteFilm($id) {
    $apiUrl = Http::get("{$this->apiBaseUrl}/film/getById?id={$id}");

    $response = ($apiUrl);

    if ($response->failed()) {
        return redirect()->route('film.index')->with('error', 'Film introuvable.');
    }

    $film = $response->json();

    return view('DeleteFilm', compact('film'));
}

public function afficherInventaire($filmId)
{
    // Appelle l'API Spring Boot
    $response = Http::get("http://localhost:8080/toad/inventory/getStockByStore");

    if ($response->successful()) {
        $inventaireData = collect($response->json())->where('filmId', $filmId);

        if ($inventaireData->isEmpty()) {
            return view('inventaire', [
                'film' => ['title' => 'Film non trouvé'],
                'inventaire' => []
            ]);
        }

        return view('inventaire', [
            'film' => ['title' => $inventaireData->first()['title']],
            'inventaire' => $inventaireData->all()
        ]);
    } else {
        return redirect()->back()->with('error', 'Erreur lors de la récupération des données.');
    }
}

public function updateIventory(Request $request)
{
    $storeId = $request->input('store_id');
    $filmId = $request->input('film_id');
    $action = $request->input('action');

    $inventory = Inventory::where('store_id', $storeId)->where('film_id', $filmId)->first();

    $storeId = $request->input('store_id');
    $filmId = $request->input('film_id');
    $action = $request->input('action');

    // Récupération de la quantité actuelle
    $row = DB::table('inventory')
        ->where('store_id', $storeId)
        ->where('film_id', $filmId)
        ->first();



}

}

    