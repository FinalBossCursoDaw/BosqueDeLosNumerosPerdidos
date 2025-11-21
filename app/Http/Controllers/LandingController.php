<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Mostrar la página principal (landing page)
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Mostrar la página de login
     */
    public function login()
    {
        return view('login');
    }
}
