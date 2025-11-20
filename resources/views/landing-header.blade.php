<!DOCTYPE html>
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
                    <a href="#" class="hover:text-[#FED32C] transition-all text-stroke relative group">
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
                <li class="transform hover:scale-110 transition-all duration-300">
                    <a href="#" class="hover:text-[#FED32C] transition-all text-stroke relative group">
                        Idioma
                        <span class="absolute -bottom-2 left-0 w-0 h-1 bg-[#FED32C] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </li>
            </ul>
            <div class="animate-pulse-slow">
                <a href="#" class="bg-[#4CAF50] hover:bg-[#45A049] hover:shadow-2xl hover:scale-105 text-[#FFFBE9] py-3 px-12 rounded-xl text-2xl transition-all duration-300 shadow-lg border-[6px] border-[#2E7D32] inline-block hover:-translate-y-1">
                    Comenzar
                </a>
            </div>
        </nav>
    </header>

    @yield('content')

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
    </script>
</body>
</html>