<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255|unique:users',
            'age' => 'required|integer|min:0',
            'date_naissance' => 'required|date',
            'genre' => 'required|string',
            'type_membre' => 'required|string',
            'photo_profil' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Gérer l'upload de la photo
        $cheminPhoto = null;
        if ($request->hasFile('photo_profil')) {
            $cheminPhoto = $request->file('photo_profil')->store('photos_profil', 'public');
        }

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'pseudo' => $request->pseudo,
            'age' => $request->age,
            'date_naissance' => $request->date_naissance,
            'genre' => $request->genre,
            'type_membre' => $request->type_membre,
            'photo_profil' => $cheminPhoto,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'points' => 0, // par défaut
            'niveau' => 'débutant', // par défaut
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
