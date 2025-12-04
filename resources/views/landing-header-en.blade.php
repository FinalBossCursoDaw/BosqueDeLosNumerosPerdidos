<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Forest of Lost Numbers')</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logojuego.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @yield('styles')
</head>
<body class="@yield('body-class', 'mt-16')">
    <header id="header" class="fixed top-0 left-0 right-0 h-32 bg-left bg-[#C27525] z-[100] transition-transform duration-300" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: auto 100%; background-repeat: repeat-x;">
        <nav class="flex items-center justify-between px-8 h-full relative z-10">
            <div class="flex items-center -my-4 animate-bounce-slow">
                <a href="{{ route('home.en') }}">
                    <img src="{{ asset('imagenes/logojuego.png') }}" alt="Sumina" class="h-32 w-32 hover:scale-110 transition-transform duration-300 cursor-pointer">
                </a>
            </div>
            <ul class="flex gap-20 text-yellow-400 text-3xl">
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="{{ route('home.en') }}" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        Home
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="{{ route('clasificacion') }}" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        Rankings
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="#conocenos" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        About Us
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
                <li class="transform hover:scale-110 transition-all duration-300 relative group">
                    <button class="hover:text-[#FED32C] transition-all text-stroke relative flex items-center gap-2">
                        Language
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div class="absolute top-full mt-2 right-0 bg-[#C27525] rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 min-w-[200px] border-4 border-yellow-400 z-[110]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: auto 100%; background-repeat: repeat-x;">
                        <ul class="py-2">
                            <li>
                                <a href="{{ route('home') }}" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/BanderaEspañola.png') }}" alt="España" class="w-6 h-4 object-cover">
                                    Spanish
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home.en') }}" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/BanderaUK.png') }}" alt="UK" class="w-6 h-4 object-cover">
                                    English
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home.ca') }}" class="block px-6 py-3 text-yellow-400 hover:text-[#FED32C] hover:bg-[#A85D1F] transition-all duration-200 text-2xl text-stroke flex items-center gap-2">
                                    <img src="{{ asset('imagenes/Bandera_catalana.svg') }}" alt="Català" class="w-6 h-4 object-cover">
                                    Catalan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-[#E91E63] hover:bg-[#C2185B] hover:shadow-2xl hover:scale-105 text-white py-3 px-12 rounded-xl text-2xl transition-all duration-300 shadow-lg border-[6px] border-[#AD1457] inline-block hover:-translate-y-1">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-[#4CAF50] hover:bg-[#45A049] hover:shadow-2xl hover:scale-105 text-[#FFFBE9] py-3 px-12 rounded-xl text-2xl transition-all duration-300 shadow-lg border-[6px] border-[#2E7D32] inline-block hover:-translate-y-1">
                    Start
                </a>
            @endif
        </nav>
    </header>

    @yield('content')

    
</body>
</html>
