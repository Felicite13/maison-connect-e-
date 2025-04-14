<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Affiche la page de profil de l'utilisateur
    public function index()
    {
        $utilisateur = Auth::user(); //recup l'utilisateur connecté 
        return view('profil.index', compact('utilisateur'));
    } // et on envoie à la vue via la variable $utilisateur 
}
