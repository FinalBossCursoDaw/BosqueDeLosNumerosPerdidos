<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - El Bosque de los Números Perdidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(254, 211, 44, 0.3); }
            50% { box-shadow: 0 0 40px rgba(254, 211, 44, 0.6); }
        }
        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        .wood-texture {
            background-image: url('{{ asset('imagenes/header-wood.png') }}');
            background-size: cover;
            background-position: center;
        }
        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen relative overflow-hidden">
    <!-- Fondo difuminado -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}'); filter: blur(8px); transform: scale(1.1);"></div>
    
    <!-- Overlay con gradiente -->
    <div class="absolute inset-0 bg-gradient-to-b from-green-900/40 via-yellow-900/30 to-green-900/40"></div>
    
    <!-- Partículas decorativas flotantes -->
    <div class="absolute top-20 left-20 w-16 h-16 bg-[#FED32C]/20 rounded-full blur-xl animate-float"></div>
    <div class="absolute top-40 right-32 w-20 h-20 bg-[#FFD700]/20 rounded-full blur-xl animate-float" style="animation-delay: 0.5s;"></div>
    <div class="absolute bottom-32 left-40 w-12 h-12 bg-[#FFA500]/20 rounded-full blur-xl animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 right-20 w-24 h-24 bg-[#FFEAA7]/20 rounded-full blur-xl animate-float" style="animation-delay: 1.5s;"></div>
    
    <!-- Logo superior izquierdo -->
    <div class="absolute top-8 left-8 z-20 ">
        <img src="{{ asset('imagenes/logojuego.png') }}" alt="Logo" class="h-40 w-auto transform">
    </div>
    
    <!-- Botón Volver arriba derecha -->
    <div class="absolute top-8 right-8 z-20">
        <a href="{{ route('home') }}" class="bg-transparent hover:bg-white/20 text-white font-black text-xl py-3 px-8 rounded-xl border-4 border-transparent hover:border-white inline-flex items-center gap-2 transition-all duration-300 backdrop-blur-sm hover:shadow-2xl hover:scale-105" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
        </a>
    </div>
    
    <!-- Contenido principal -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-8">
        <div class="w-full max-w-6xl flex flex-col md:flex-row items-center gap-12">
            <!-- Formulario de login -->
            <div class="w-full md:w-3/5 bg-gradient-to-br from-[#FFEAA7]/30 via-[#F9D68A]/30 to-[#E8C574]/30 rounded-3xl p-3 shadow-2xl backdrop-blur-sm" style="border: 8px solid #4CAF50; box-shadow: 0 25px 50px rgba(0,0,0,0.5), 0 0 30px rgba(254, 211, 44, 0.3), 0 0 0 2px rgba(255, 234, 167, 0.5) inset;">
                <div class="wood-texture rounded-2xl p-12 relative overflow-hidden" style="box-shadow: 0 10px 30px rgba(0,0,0,0.3) inset;">
                  
                    
                    <!-- Efecto de brillo superior e inferior -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-[#FED32C]/50 to-transparent animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-[#FED32C]/50 to-transparent animate-pulse"></div>
                    
                    <h1 class="text-[#FED32C] text-6xl font-black text-center mb-4 relative" style="-webkit-text-stroke: 3px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.5);">
                        ¡Bienvenido!
                    </h1>
                    <p class="text-[#FFEAA7] text-center mb-10 text-lg font-bold" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8), 0 0 20px rgba(255, 234, 167, 0.3);">
                         Inicia sesión para continuar tu aventura 
                    </p>
                    
                    @if ($errors->any())
                        <div class="bg-red-500/80 text-white px-6 py-4 rounded-xl mb-4 backdrop-blur-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-500/80 text-white px-6 py-4 rounded-xl mb-4 backdrop-blur-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" class="space-y-7">
                        @csrf
                        
                        <!-- Email o Usuario -->
                        <div>
                            <label for="email" class="block text-[#FFEAA7] text-lg font-bold mb-3 flex items-center gap-2" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                                <span class="text-[#FED32C] text-2xl"></span> Email
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-6 py-4 bg-gradient-to-r from-white/95 to-[#FFEAA7]/20 border-4 border-[#D4A574] rounded-2xl text-gray-800 font-semibold placeholder-gray-500 focus:outline-none focus:border-[#FED32C] focus:ring-4 focus:ring-[#FED32C]/50"
                                style="box-shadow: 0 8px 20px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.5);"
                                placeholder="Ingresa tu email"
                                required
                            >
                        </div>
                        
                        <!-- Contraseña -->
                        <div>
                            <label for="password" class="block text-[#FFEAA7] text-lg font-bold mb-3 flex items-center gap-2" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                                <span class="text-[#FED32C] text-2xl"></span> Contraseña
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-6 py-4 bg-gradient-to-r from-white/95 to-[#FFEAA7]/20 border-4 border-[#D4A574] rounded-2xl text-gray-800 font-semibold placeholder-gray-500 focus:outline-none focus:border-[#FED32C] focus:ring-4 focus:ring-[#FED32C]/50"
                                style="box-shadow: 0 8px 20px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.5);"
                                placeholder="Ingresa tu contraseña"
                                required
                            >
                        </div>
                        
                        
                        
                        <!-- Botón Iniciar Sesión -->
                        <button 
                            type="submit" 
                            class="w-full bg-[#4CAF50] hover:bg-[#45A049] text-white font-black text-2xl py-6 rounded-2xl shadow-lg border-[6px] border-[#2E7D32]"
                        >
                            Iniciar Sesión
                        </button>
                        
                        <!-- Registro -->
                        <p class="text-[#FFEAA7] text-center text-lg mt-6 font-bold" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                            ¿No tienes una cuenta? 
                            <a href="#" class="text-[#FED32C] font-black hover:text-[#FFE566] transition-all hover:scale-110 inline-block transform" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8), 0 0 20px rgba(254, 211, 44, 0.5);">
                                 Crea una aquí
                            </a>
                        </p>
                    </form>
                </div>
            </div>
            
            <!-- Imagen Sumina -->
            <div class="w-full md:w-2/5 flex justify-end items-center relative pr-12">
                <!-- Círculo decorativo detrás -->
                <div class="absolute inset-0 flex items-center justify-end pr-12">
                    <div class="w-96 h-96 bg-gradient-to-br from-[#FED32C]/20 to-[#FFD700]/20 rounded-full blur-2xl animate-pulse"></div>
                </div>
                
                <!-- Sumina con animación -->
                <div class="relative animate-float">
                    <img 
                        src="{{ asset('imagenes/abejasunima.png') }}" 
                        alt="Sumina" 
                        class="w-full max-w-md h-auto object-contain"
                        style="filter: drop-shadow(0 25px 50px rgba(254, 211, 44, 0.5)) drop-shadow(0 0 40px rgba(255, 215, 0, 0.4));"
                    >
                </div>
            </div>
        </div>
    </div>
</body>
</html>
