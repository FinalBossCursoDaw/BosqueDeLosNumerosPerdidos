<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/login', [LandingController::class, 'login'])->name('login');          