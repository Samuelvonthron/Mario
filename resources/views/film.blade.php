<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Menu de recherche et filtres -->
                    <form method="GET" action="{{ route('film') }}" class="flex items-center space-x-4 mb-6">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Rechercher un film..." 
                            class="border border-black px-4 py-2 w-full"
                        />

                        <select name="filter" class="border border-black px-4 py-2">
                            <option value="">Filtrer par...</option>
                            <option value="genre" {{ request('filter') == 'genre' ? 'selected' : '' }}>Genre</option>
                            <option value="epoque" {{ request('filter') == 'epoque' ? 'selected' : '' }}>Époque</option>
                            <option value="realisatrice" {{ request('filter') == 'realisatrice' ? 'selected' : '' }}>Réalisatrice</option>
                        </select>

                        <button type="submit" class="border border-black bg-white px-4 py-2">Rechercher</button>
                    </form>


                    <!-- Bouton Ajouter un nouveau film -->
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('film.create') }}" class="border border-black bg-white px-6 py-2">
                            Ajouter un nouveau film
                        </a>
                    </div>

                    <!-- Liste des films -->
                    <div class="film-list">
                        @if(isset($films) && count($films) > 0)
                            @foreach ($films as $film)
                                <div class="film-item border border-black p-4 mb-4">
                                    <h3 class="text-lg font-bold">{{ $film['title'] }}</h3>
                                    <p>Genre : {{ $film['description'] }}</p>
                                    <p>Année : {{ $film['releaseYear'] }}</p>
                                    
                                    <div class="flex justify-between mt-4">
                                        <a 
                                            href="details/{{ $film['filmId'] }}"
                                            class="text-black border border-black px-4 py-2"
                                        >
                                            Détails
                                        </a>
                                        <a href="{{ route('film.delete', ['id' => $film['filmId']]) }}" 
                                            class="text-black border border-black px-4 py-2">
                                            Supprimer
                                        </a>

                                        <a 
                                            href="edit/{{ ($film['filmId'])}}"
                                            class="text-black border border-black px-4 py-2"
                                        >
                                            Modifier
                                        </a>

                                        <a href="{{ route('film.inventaire', ['filmId' => $film['filmId']]) }}" 
                                            class="text-black border border-black px-4 py-2">
                                            Inventaire
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-black">Aucun film trouvé.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .film-list .film-item {
        border: 1px solid black;
        padding: 16px;
        margin-bottom: 16px;
        background-color: #f9f9f9;
    }

    .film-item h3 {
        margin-bottom: 8px;
    }

    .film-item p {
        margin: 4px 0;
    }

    button {
        cursor: pointer;
    }

    button:hover {
        background-color: #eaeaea;
    }
</style>
