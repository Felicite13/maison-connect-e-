<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mon profil') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">Informations personnelles</h3>

                <ul class="space-y-2">
                    <li><strong>Prénom :</strong> {{ $utilisateur->prenom }}</li>
                    <li><strong>Nom :</strong> {{ $utilisateur->nom }}</li>
                    <li><strong>Pseudo :</strong> {{ $utilisateur->pseudo }}</li>
                    <li><strong>Âge :</strong> {{ $utilisateur->age }}</li>
                    <li><strong>Date de naissance :</strong> {{ $utilisateur->date_de_naissance }}</li>
                    <li><strong>Genre :</strong> {{ $utilisateur->genre }}</li>
                    <li><strong>Adresse e-mail :</strong> {{ $utilisateur->email }}</li>
                    <li><strong>Points :</strong> {{ $utilisateur->points }}</li>
                    <li><strong>Niveau :</strong> {{ $utilisateur->niveau }}</li>
                    <li><strong>Type de membre :</strong> {{ $utilisateur->type_membre }}</li>
                </ul>

                {{-- Plus tard : bouton "modifier mon profil" --}}
            </div>
        </div>
    </div>
</x-app-layout>
