<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Juego;
use Illuminate\Support\Facades\DB;

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
     * Mostrar la página principal en catalán
     */
    public function indexCatalan()
    {
        return view('landing-ca');
    }

    /**
     * Mostrar la página principal en inglés
     */
    public function indexEnglish()
    {
        return view('landing-en');
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
     * Mostrar la página de historia en catalán
     */
    public function historiaCatalan()
    {
        return view('historia-ca');
    }

    /**
     * Mostrar la página de historia en inglés
     */
    public function historiaEnglish()
    {
        return view('historia-en');
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

    /**
     * Mostrar la clasificación del juego de sumas
     */
    public function clasificacion()
    {
        // Obtener ambos juegos
        $juegoSumas = Juego::where('nombre', 'El Bosque de las Sumas')->first();
        $juegoPuente = Juego::where('nombre', 'Puente de la Lógica')->first();
        
        // Datos del juego de sumas
        $topJugadoresSumas = [];
        $totalPartidasSumas = 0;
        $partidasCompletadasSumas = 0;
        $promedioPuntuacionSumas = 0;
        
        if ($juegoSumas) {
            $topJugadoresSumas = Partida::with(['usuario', 'sesion'])
                ->where('id_juego', $juegoSumas->id_juego)
                ->orderBy('puntuacion', 'desc')
                ->orderBy('tiempo_seg', 'asc')
                ->take(10)
                ->get();

            $totalPartidasSumas = Partida::where('id_juego', $juegoSumas->id_juego)->count();
            
            $partidasCompletadasSumas = Partida::where('id_juego', $juegoSumas->id_juego)
                ->whereHas('sesion', function($query) {
                    $query->where('errors', '>', 0);
                })
                ->count();
            
            $promedioPuntuacionSumas = Partida::where('id_juego', $juegoSumas->id_juego)
                ->avg('puntuacion') ?? 0;
        }
        
        // Datos del puente de la lógica
        $topJugadoresPuente = [];
        $totalPartidasPuente = 0;
        $partidasCompletadasPuente = 0;
        $promedioTiempoPuente = 0;
        
        if ($juegoPuente) {
            $topJugadoresPuente = Partida::with(['usuario', 'sesion'])
                ->where('id_juego', $juegoPuente->id_juego)
                ->orderBy('tiempo_seg', 'asc')
                ->orderBy('puntuacion', 'desc')
                ->take(10)
                ->get();

            $totalPartidasPuente = Partida::where('id_juego', $juegoPuente->id_juego)->count();
            
            $partidasCompletadasPuente = Partida::where('id_juego', $juegoPuente->id_juego)
                ->where('puntuacion', '>', 0)
                ->count();
            
            $promedioTiempoPuente = Partida::where('id_juego', $juegoPuente->id_juego)
                ->avg('tiempo_seg') ?? 0;
        }

        return view('clasificacion', compact(
            'topJugadoresSumas',
            'totalPartidasSumas',
            'partidasCompletadasSumas',
            'promedioPuntuacionSumas',
            'topJugadoresPuente',
            'totalPartidasPuente',
            'partidasCompletadasPuente',
            'promedioTiempoPuente'
        ));
    }
}
