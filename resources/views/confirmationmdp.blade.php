<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('confirmmdp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @guest
                    
                    <div class="flex items-center space-x-4 mb-6">

                    <p> Votre mot de passe a été modifié

                    </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>