<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le film') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-6 bg-white shadow-md rounded-lg">
        <!-- Bouton Retour -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Retour</a>
        </div>

        <!-- Messages de succès ou d'erreur -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 mb-4 rounded">{{ session('error') }}</div>
        @endif

        <!-- Formulaire de modification -->
        <form action="{{ route('film.update', $film['filmId']) }}" method="POST">
            @csrf
            @method('PUT')

           <!-- Titre du film -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Titre</label>
    <input type="text" name="title" value="{{ $film['title'] ?? '' }}" class="w-full p-2 border rounded" required>
</div>

<!-- Description -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Description</label>
    <textarea name="description" rows="4" class="w-full p-2 border rounded">{{ $film['description'] ?? '' }}</textarea>
</div>

<!-- Année de sortie -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Année de sortie</label>
    <input type="number" name="releaseYear" value="{{ $film['releaseYear'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Réalisateur -->
<div class="mb-4">
        <label>Réalisateur</label>
        <input type="text" name="idDirector" value="{{ $film['idDirector'] ?? '' }}"class="w-full p-2 border rounded">
    </div>

<!-- Durée de location -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Durée de location (jours)</label>
    <input type="number" name="rentalDuration" value="{{ $film['rentalDuration'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Tarif de location -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Tarif de location</label>
    <input type="number" step="0.01" name="rentalRate" value="{{ $film['rentalRate'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Durée du film -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Durée (minutes)</label>
    <input type="number" name="length" value="{{ $film['length'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Coût de remplacement -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Coût de remplacement</label>
    <input type="number" step="0.01" name="replacementCost" value="{{ $film['replacementCost'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Classification -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Classification</label>
    <input type="text" name="rating" value="{{ $film['rating'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Fonctionnalités spéciales -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Fonctionnalités spéciales</label>
    <input type="text" name="specialFeatures" value="{{ $film['specialFeatures'] ?? '' }}" class="w-full p-2 border rounded">
</div>

<!-- Dernière mise à jour -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Dernière mise à jour</label>
    <input type="datetime-local" name="lastUpdate" value="{{ $film['lastUpdate'] ?? '' }}" class="w-full p-2 border rounded">
</div>

            <!-- Boutons -->
            <div class="flex space-x-4">
                <button type="submit" onclick="window.history.back();" class="text-black border border-black px-4 py-2">Mettre à jour</button>
            </div>
        </form>
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

    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        border: 1px solid black;
        padding: 8px;
        background-color: white;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input, textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid black;
        border-radius: 4px;
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