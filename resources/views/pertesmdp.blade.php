<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pertes mdp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Menu de recherche et filtres -->
                    <div class="flex items-center space-x-4 mb-6">
                    @guest
                    <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <label for="mdp">Nouveau Mot de passe</label>
                    <input type="text" id="mdp" name="mdp" required minlength="12" />

                    <label for="mdp">resaisissé le meme Mot de passe</label>
                    <input type="text" id="mdpverif" name="mdpverif" required minlength="12" />
                    </form>
                    <form action="{{ route('password.confirm') }}" method="GET">
                        <button type="submit" class="styled"></button>
                    </form>

                    
                    </div>
                @endguest
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        