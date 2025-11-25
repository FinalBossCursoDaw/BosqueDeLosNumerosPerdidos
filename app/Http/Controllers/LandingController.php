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
        // Si el usuario está autenticado, mostrar la versión con header de usuario
        if (auth()->check()) {
            return view('landing-authenticated');
        }
        
        // Si no está autenticado, mostrar el landing normal
        return view('landing');
    }

    /**
     * Mostrar la página de login
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Mostrar la página de registro
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Mostrar la página de historia
     */
    public function historia()
    {
        return view('historia');
    }
}
