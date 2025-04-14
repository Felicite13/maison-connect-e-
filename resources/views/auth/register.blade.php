<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Affichage des erreurs de validation -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Adresse mail -->
            <div class="mt-4">
                <label for="email">Adresse mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="block mt-1 w-full">
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required class="block mt-1 w-full" autocomplete="new-password">
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mt-4">
                <label for="password_confirmation">Confirmation du mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="block mt-1 w-full">
            </div>

            <!-- Nom -->
            <div class="mt-4">
                <label for="nom">Nom</label>
                <input id="nom" type="text" name="nom" required class="block mt-1 w-full">
            </div>

            <!-- Prénom -->
            <div class="mt-4">
                <label for="prenom">Prénom</label>
                <input id="prenom" type="text" name="prenom" required class="block mt-1 w-full">
            </div>

            <!-- Pseudo -->
            <div class="mt-4">
                <label for="pseudo">Pseudo</label>
                <input id="pseudo" type="text" name="pseudo" required class="block mt-1 w-full">
            </div>

            <!-- Âge -->
            <div class="mt-4">
                <label for="age">Âge</label>
                <input id="age" type="number" name="age" required class="block mt-1 w-full">
            </div>

            <!-- Date de naissance -->
            <div class="mt-4">
                <label for="date_naissance">Date de naissance</label>
                <input id="date_naissance" type="date" name="date_naissance" required class="block mt-1 w-full">
            </div>

            <!-- Genre -->
            <div class="mt-4">
                <label for="genre">Genre</label>
                <select id="genre" name="genre" required class="block mt-1 w-full">
                    <option value="">-- Sélectionner --</option>
                    <option value="femme">Femme</option>
                    <option value="homme">Homme</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <!-- Type de membre -->
            <div class="mt-4">
                <label for="type_membre">Type de membre</label>
                <select id="type_membre" name="type_membre" required class="block mt-1 w-full">
                    <option value="">-- Sélectionner --</option>
                    <option value="mère">Mère</option>
                    <option value="père">Père</option>
                    <option value="enfant">Enfant</option>
                    <option value="colocataire">Colocataire</option>
                </select>
            </div>

            <!-- Photo de profil -->
            <div class="mt-4">
                <label for="photo_profil">Photo de profil</label>
                <input id="photo_profil" type="file" name="photo_profil" accept="image/*" class="block mt-1 w-full">
            </div>

            <!-- Lien vers la connexion -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Déjà inscrit ? Se connecter
                </a>

                <x-button class="ml-4">
                    S’inscrire
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>