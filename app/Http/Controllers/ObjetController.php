<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjetController extends Controller
{
    // Cette méthode affiche la liste des objets connectés
    public function index()
    {
        return view('objets.index');
    }
}
