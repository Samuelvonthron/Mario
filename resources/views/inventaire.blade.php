<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventaire - {{ $film['title'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($inventaire) > 0)
                        <table class="w-full border-collapse border border-gray-800">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-800 px-4 py-2">Adresse</th>
                                    <th class="border border-gray-800 px-4 py-2">District</th>
                                    <th class="border border-gray-800 px-4 py-2">Quantité Disponible</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaire as $item)
                                    <tr>
                                        <td class="border border-gray-800 px-4 py-2">{{ $item['address'] }}</td>
                                        <td class="border border-gray-800 px-4 py-2">{{ $item['district'] }}</td>
                                        <td class="border border-gray-800 px-4 py-2 text-center">{{ $item['quantity'] }}</td>
                                    </tr>
                                    <td class="border border-gray-800 px-4 py-2 text-center">
                                        {{ $item['quantity'] }}

                                        <form action="{{ route('inventaire.update') }}" method="POST" class="inline-block mt-2">
                                            @csrf
                                            <input type="hidden" name="store_id" value="{{ $item['store_id'] }}">
                                            <input type="hidden" name="film_id" value="{{ $film['film_id'] }}">

                                            <button name="action" value="add_1" class="px-2 text-green-600">➕1</button>
                                            <button name="action" value="add_10" class="px-2 text-green-600">➕10</button>
                                            <button name="action" value="remove_1" class="px-2 text-red-600">➖1</button>
                                            <button name="action" value="remove_10" class="px-2 text-red-600">➖10</button>
                                        </form>
                                    </td>

                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-gray-600">Aucune donnée d'inventaire disponible.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 border border-black bg-gray-200">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<style>
    h1, h2 {
        color: black;
        text-align: center;
    }
    p, li {
        font-size: 16px;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
</style>