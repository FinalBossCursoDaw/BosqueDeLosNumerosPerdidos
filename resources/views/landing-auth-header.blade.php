<!DOCTYPE html>
<<<<<<< HEAD
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bosque De Los Numeros Perdidos')</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logojuego.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @yield('styles')
</head>
<body class="@yield('body-class', 'mt-16')">
    <header id="header" class="fixed top-0 left-0 right-0 h-32 bg-left bg-[#C27525] z-[100] transition-transform duration-300" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: auto 100%; background-repeat: repeat-x;">
        <nav class="flex items-center justify-between px-8 h-full relative z-10">
            <div class="flex items-center -my-4 animate-bounce-slow">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('imagenes/logojuego.png') }}" alt="Sumina" class="h-32 w-32 hover:scale-110 transition-transform duration-300 cursor-pointer">
                </a>
            </div>
            <ul class="flex gap-20 text-yellow-400 text-3xl">
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="{{ route('home') }}" class="hover:text-[#FED32C] transition-all text-stroke relative group">
=======
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bosque De Los Numeros Perdidos</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logojuego.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body class="mt-16">
    <header id="header" class="fixed top-0 left-0 right-0 h-32 bg-left bg-[#C27525] overflow-hidden z-50 transition-transform duration-300" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: auto 100%; background-repeat: repeat-x;">
        <nav class="flex items-center justify-between px-8 h-full relative z-10">
            <div class="flex items-center -my-4 animate-bounce-slow">
                <img src="{{ asset('imagenes/logojuego.png') }}" alt="Sumina" class="h-32 w-32 hover:scale-110 transition-transform duration-300 cursor-pointer">
            </div>
            <ul class="flex gap-20 text-yellow-400 text-3xl">
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="{{ route('landing') }}" class="hover:text-[#FED32C] transition-all text-stroke relative group">
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
                        Inicio
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="#conocenos" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        Conócenos
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
<<<<<<< HEAD
                <li class="transform hover:scale-110 transition-all duration-300 relative group">
                    <button class="hover:text-[#FED32C] transition-all text-stroke relative flex items-center gap-2">
                        Idioma
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div class="absolute top-full mt-2 right-0 bg-[#C27525] rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 min-w-[200px] border-4 border-yellow-400 z-[110]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: auto 100%; background-repeat: repeat-x;">
                        <ul class="py-2">
                            <li>
                                <a href="#" onclick="changeLanguage('es'); return false;" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/BanderaEspañola.png') }}" alt="España" class="w-6 h-4 object-cover">
                                    Castellano
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="changeLanguage('en'); return false;" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/BanderaUK.png') }}" alt="UK" class="w-6 h-4 object-cover">
                                    English
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="changeLanguage('ca'); return false;" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/Bandera_catalana.svg') }}" alt="Català" class="w-6 h-4 object-cover">
                                    Català
                                </a>
                            </li>
                        </ul>
                    </div>
=======
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="#" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        Idioma
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
                </li>
            </ul>
            <!-- Menú de usuario autenticado -->
            <div class="relative group">
                <button class="flex items-center gap-3 bg-[#4CAF50] hover:bg-[#45A049] text-[#FFFBE9] py-3 px-6 rounded-xl text-xl transition-all duration-300 shadow-lg border-[6px] border-[#2E7D32] hover:scale-105">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
<<<<<<< HEAD
                    <span class="font-bold">{{ Auth::user()->nombre }}</span>
=======
                    <span class="">{{ Auth::user()->nombre }}</span>
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-180 duration-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                
                <!-- Dropdown menu -->
<<<<<<< HEAD
                <div class="absolute right-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2 z-[110]">
=======
                <div class="absolute right-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2 z-[60]">
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
                    <div class="bg-[#C27525] rounded-xl shadow-2xl border-4 border-[#8B5A2B] overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover;">
                        <div class="py-2">
                            <a href="#" class="block px-6 py-3 text-[#FFFBE9] hover:bg-[#4CAF50]/30 transition-all duration-200 text-lg font-bold flex items-center gap-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                Mi Perfil
                            </a>
                            <a href="#" class="block px-6 py-3 text-[#FFFBE9] hover:bg-[#4CAF50]/30 transition-all duration-200 text-lg font-bold flex items-center gap-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                                </svg>
                                Configuración
                            </a>
                            <hr class="border-[#8B5A2B] border-2 my-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-3 text-[#FED32C] hover:bg-red-600/30 transition-all duration-200 text-lg font-black flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                    </svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

<<<<<<< HEAD
    @yield('scripts')
    
=======
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
    <script>
        let lastScrollTop = 0;
        const header = document.getElementById('header');
        
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Bajando - ocultar header
                header.style.transform = 'translateY(-100%)';
            } else {
                // Subiendo - mostrar header
                header.style.transform = 'translateY(0)';
            }
            
            lastScrollTop = scrollTop;
        });
<<<<<<< HEAD

        function changeLanguage(lang) {
            console.log('Cambiando idioma a: ' + lang);
            // Aquí puedes implementar la lógica de cambio de idioma
        }
=======
>>>>>>> c0fca6e9cf0e4c7229343a668d7376887e219098
    </script>
</body>
</html>
