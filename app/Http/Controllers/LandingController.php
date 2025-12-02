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

    /**
     * Mostrar el juego de sumas
     */
    public function juegoSumas()
    {
        return view('juego-sumas');
    }

    /**
     * Mostrar el juego del puente lógico
     */
    public function juegosPuente()
    {
        return view('puente-logica');
    }
}
