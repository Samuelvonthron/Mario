<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NewFilm') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <!-- Bouton Retour -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Retour</a>
        </div>

        <!-- Titre -->
        <h1 class="text-2xl font-bold mb-6">{{ $film['nom'] }}</h1>

        <!-- Table de consultation/modification -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="font-bold">Disponibilité</div>
            <div>
                <button class="px-4 py-2 {{ $film['disponibilite'] ? 'bg-green-500' : 'bg-red-500' }} text-white rounded">
                    {{ $film['disponibilite'] ? 'Oui' : 'Non' }}
                </button>
            </div>

            <div class="font-bold">Client</div>
            <div>{{ $film['client'] }}</div>

            <div class="font-bold">Lieu de stockage</div>
            <div>{{ $film['lieu_stockage'] }}</div>

            <div class="font-bold">Date d'emprunt</div>
            <div>{{ $film['date_emprunt'] }}</div>

            <div class="font-bold">Date de rendu</div>
            <div>{{ $film['date_rendu'] }}</div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">Description</h2>
            <p class="border border-gray-300 p-4 rounded">{{ $film['description'] }}</p>
        </div>

        <!-- État -->
        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">État</h2>
            <p class="border border-gray-300 p-4 rounded">{{ $film['etat'] }}</p>
        </div>

        <!-- Boutons -->
        <div class="flex space-x-4">
        <a 
            href="edit/{{ ($film['filmId'])}}"
            class="text-black border border-black px-4 py-2"
        >
            Modifier
        </a>
            
    </div>
</x-app-layout>


    

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        color: black;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid black;
        padding: 20px;
        background-color: #f9f9f9;
    }

    h1 {
        text-align: center;
        color: #333;
        border-bottom: 2px solid black;
        padding-bottom: 10px;
    }

    .detail {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        border: 1px solid black;
        padding: 8px;
    }

    .label {
        font-weight: bold;
        width: 200px;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .actions button {
        padding: 10px 15px;
        border: 1px solid black;
        cursor: pointer;
        background-color: white;
    }

    .actions .modify {
        background-color: #4CAF50;
        color: white;
    }

    .actions .delete {
        background-color: #f44336;
        color: white;
    }

    .actions .back {
        background-color: #555;
        color: white;
    }

    .actions button:hover {
        background-color: #eaeaea;
    }
</style>