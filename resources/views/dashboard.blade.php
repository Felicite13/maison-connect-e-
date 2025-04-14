<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mon Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg p-6">

                {{-- Message de bienvenue --}}
                <h3 class="text-lg font-bold mb-4">
                    Bonjour {{ Auth::user()->pseudo }} !
                </h3>

                {{-- Statistiques utilisateur --}}
                <ul class="mb-6">
                    <li><strong>Type de membre :</strong> {{ Auth::user()->type_membre }}</li>
                    <li><strong>Points :</strong> {{ Auth::user()->points }}</li>
                    <li><strong>Niveau :</strong> {{ Auth::user()->niveau }}</li>
                </ul>

                {{-- Boutons d'accès --}}
                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('profil.index') }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Voir mon profil
                    </a>
                    <a href="{{ route('objets.index') }}" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        Gérer mes objets connectés
                    </a>
                </div>

                {{-- Optionnel : affichage selon rôle ou points --}}
                @if(Auth::user()->type_membre === 'admin')
                <div class="mt-6 p-4 bg-gray-100 border rounded">
                    <p class="font-semibold">Fonctionnalités administrateur :</p>
                    <a href="{{ route('admin.panel') }}" class="text-blue-600 underline">
                        Accéder au panneau d'administration
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>