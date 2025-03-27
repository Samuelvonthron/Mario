<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Film</title>
</head>
<body>
<div class="container">
    <h1>Supprimer un Film</h1>

    <form action="{{ route('film.delete', ['id' => $film['filmId']]) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <label>Titre</label>
            <div class="value">{{ $film['title'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Année de sortie</label>
            <div class="value">{{ $film['releaseYear'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Réalisateur</label>
            <div class="value">{{ $film['idDirector'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Durée de location (jours)</label>
            <div class="value">{{ $film['rentalDuration'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Tarif de location</label>
            <div class="value">{{ $film['rentalRate'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Durée (minutes)</label>
            <div class="value">{{ $film['length'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Coût de remplacement</label>
            <div class="value">{{ $film['replacementCost'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Classification</label>
            <div class="value">{{ $film['rating'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Fonctionnalités spéciales</label>
            <div class="value">{{ $film['specialFeatures'] ?? 'N/A' }}</div>
        </div>

        <div class="form-group">
            <label>Dernière mise à jour</label>
            <div class="value">{{ $film['lastUpdate'] ?? 'N/A' }}</div>
        </div>

        <!-- Boutons -->
        <div class="actions">
            <button type="submit" class="delete">Supprimer</button>
            <button type="button" class="back" onclick="window.history.back();">Retour</button>
        </div>
    </form>
</div>
</body>
</html>

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
        flex-direction: row;
        align-items: center;
        border: 1px solid black;
        padding: 8px;
        background-color: white;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    .value {
        flex-grow: 1;
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
