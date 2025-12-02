<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    /**
     * Procesar el inicio de sesión
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buscar el usuario por email
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Iniciar sesión
            Auth::login($usuario);
            
            // Redirigir a la página principal o dashboard
            return redirect()->route('home')->with('success', '¡Bienvenido ' . $usuario->nombre . '!');
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }

    /**
<<<<<<< HEAD
     * Procesar el registro de nuevo usuario
=======
     * Procesar el registro
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
     */
    public function register(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
=======
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:Usuarios,email|max:150',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
        ]);

        // Crear el nuevo usuario
        $usuario = Usuario::create([
<<<<<<< HEAD
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
=======
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'estudiante',
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
        ]);

        // Iniciar sesión automáticamente
        Auth::login($usuario);
<<<<<<< HEAD
        
        // Redirigir a la página principal
        return redirect()->route('home')->with('success', '¡Cuenta creada exitosamente! Bienvenido ' . $usuario->nombre . '!');
=======

        // Redirigir a la página principal
        return redirect()->route('home')->with('success', '¡Bienvenido ' . $usuario->nombre . '! Tu cuenta ha sido creada exitosamente.');
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
