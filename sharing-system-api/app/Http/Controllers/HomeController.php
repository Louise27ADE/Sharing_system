<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Méthode pour afficher la page d'accueil
    public function index()
    {
        return view('home');
    }

    // Méthode pour afficher le tableau de bord
    public function dashboard()
    {
        return view('dashboard');
    }
}
