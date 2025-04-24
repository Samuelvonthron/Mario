<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends Controller
{
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

            return redirect()->route('films.index')->with('success', 'Connexion réussie.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
 