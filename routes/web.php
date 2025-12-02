<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CookieController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/historia', [LandingController::class, 'historia'])->name('historia');
Route::get('/clasificacion', [LandingController::class, 'clasificacion'])->name('clasificacion');
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [LandingController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Juegos (accesibles sin autenticación)
Route::get('/juegos/sumas', [LandingController::class, 'juegoSumas'])->name('juego-sumas');
Route::get('/juegos/puente-logica', [LandingController::class, 'juegosPuente'])->name('puente-logica');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Rutas para leer cookies desde Laravel
    Route::get('/cookies/sumas', [CookieController::class, 'getSumasData'])->name('cookies.sumas');
    Route::get('/cookies/puente', [CookieController::class, 'getPuenteData'])->name('cookies.puente');
    Route::get('/cookies/all', [CookieController::class, 'getAllData'])->name('cookies.all');
    
    // Rutas para guardar partidas en la base de datos
    Route::post('/partida/save', [CookieController::class, 'savePartida'])->name('partida.save');
    Route::get('/partidas', [CookieController::class, 'getPartidas'])->name('partidas.get');
});
