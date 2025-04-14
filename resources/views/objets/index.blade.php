<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mes objets connectés') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Liste de mes objets connectés
                </h3>

                {{-- Message temporaire si aucun objet --}}
                <p class="text-gray-600 mb-4">
                    Vous n'avez pas encore d’objet connecté. Cliquez sur le bouton ci-dessous pour en ajouter un.
                </p>

                {{-- Bouton Ajouter --}}
                <a href="#" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Ajouter un objet connecté
                </a>

                {{-- Future section avec les objets (tableau ou cartes) --}}
                {{-- À faire plus tard : récupération et affichage des objets --}}
            </div>
        </div>
    </div>
</x-app-layout>
