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
        <img src="{{ asset('imagenes/logoJuego.png') }}" alt="Logo" class="h-40 w-auto transform">
    </div>
    
    <!-- Contenido principal -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-8">
        <div class="w-full max-w-6xl flex flex-col md:flex-row items-center gap-12">
            <!-- Formulario de login -->
            <div class="w-full md:w-3/5 bg-gradient-to-br from-[#FFEAA7]/30 via-[#F9D68A]/30 to-[#E8C574]/30 rounded-3xl p-3 shadow-2xl transform hover:scale-[1.02] transition-all duration-500 backdrop-blur-sm" style="border: 8px solid #D4A574; box-shadow: 0 25px 50px rgba(0,0,0,0.5), 0 0 30px rgba(254, 211, 44, 0.3), 0 0 0 2px rgba(255, 234, 167, 0.5) inset;">
                <div class="wood-texture rounded-2xl p-12 relative overflow-hidden" style="box-shadow: 0 10px 30px rgba(0,0,0,0.3) inset;">
                  
                    
                    <!-- Efecto de brillo superior e inferior -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-[#FED32C]/50 to-transparent animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-full h-2 bg-gradient-to-r from-transparent via-[#FED32C]/50 to-transparent animate-pulse"></div>
                    
                    <h1 class="text-[#FED32C] text-6xl font-black text-center mb-4 relative transform hover:scale-105 transition-transform duration-300" style="-webkit-text-stroke: 3px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.5);">
                        ¡Bienvenido!
                    </h1>
                    <p class="text-[#FFEAA7] text-center mb-10 text-lg font-bold" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8), 0 0 20px rgba(255, 234, 167, 0.3);">
                         Inicia sesión para continuar tu aventura 
                    </p>
                    
                    <form action="#" method="POST" class="space-y-7">
                        @csrf
                        
                        <!-- Email o Usuario -->
                        <div class="transform hover:scale-[1.02] transition-transform duration-300">
                            <label for="email" class="block text-[#FFEAA7] text-lg font-bold mb-3 flex items-center gap-2" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                                <span class="text-[#FED32C] text-2xl"></span> Email o usuario
                            </label>
                            <input 
                                type="text" 
                                id="email" 
                                name="email" 
                                class="w-full px-6 py-4 bg-gradient-to-r from-white/95 to-[#FFEAA7]/20 border-4 border-[#D4A574] rounded-2xl text-gray-800 font-semibold placeholder-gray-500 focus:outline-none focus:border-[#FED32C] focus:ring-4 focus:ring-[#FED32C]/50 transition-all transform focus:scale-[1.02]"
                                style="box-shadow: 0 8px 20px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.5);"
                                placeholder="Ingresa tu email"
                                required
                            >
                        </div>
                        
                        <!-- Contraseña -->
                        <div class="transform hover:scale-[1.02] transition-transform duration-300">
                            <label for="password" class="block text-[#FFEAA7] text-lg font-bold mb-3 flex items-center gap-2" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                                <span class="text-[#FED32C] text-2xl"></span> Contraseña
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-6 py-4 bg-gradient-to-r from-white/95 to-[#FFEAA7]/20 border-4 border-[#D4A574] rounded-2xl text-gray-800 font-semibold placeholder-gray-500 focus:outline-none focus:border-[#FED32C] focus:ring-4 focus:ring-[#FED32C]/50 transition-all transform focus:scale-[1.02]"
                                style="box-shadow: 0 8px 20px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.5);"
                                placeholder="Ingresa tu contraseña"
                                required
                            >
                        </div>
                        
                        
                        
                        <!-- Botón Iniciar Sesión -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-[#4ade80] via-[#22c55e] to-[#16a34a] text-white font-black text-2xl py-6 rounded-2xl hover:from-[#22c55e] hover:via-[#16a34a] hover:to-[#15803d] transition-all duration-300 transform hover:scale-110 hover:rotate-1 shadow-2xl relative overflow-hidden group"
                            style="box-shadow: 0 15px 35px rgba(34,197,94,0.6), 0 0 30px rgba(74, 222, 128, 0.4), inset 0 2px 4px rgba(255,255,255,0.3);"
                        >
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                <span class="text-3xl"></span>
                                Iniciar Sesión
                                <span class="text-3xl"></span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                        <!-- Olvidaste contraseña -->
                        <div class="text-center pt-2">
                            <a href="#" class="text-[#D4A574] text-sm font-normal hover:text-[#FED32C] transition-all inline-block underline opacity-80 hover:opacity-100">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
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
            <div class="w-full md:w-2/5 flex justify-center items-center relative">
                <!-- Círculo decorativo detrás -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-96 h-96 bg-gradient-to-br from-[#FED32C]/20 to-[#FFD700]/20 rounded-full blur-2xl animate-pulse"></div>
                </div>
                
                <!-- Sumina con animación -->
                <div class="relative animate-float">
                    <img 
                        src="{{ asset('imagenes/abejasunima.png') }}" 
                        alt="Sumina" 
                        class="w-full max-w-md h-auto object-contain transform hover:scale-110 hover:rotate-6 transition-all duration-500"
                        style="filter: drop-shadow(0 25px 50px rgba(254, 211, 44, 0.5)) drop-shadow(0 0 40px rgba(255, 215, 0, 0.4));"
                    >
                    
                    <!-- Estrellas alrededor de Sumina -->
                    <div class="absolute -top-8 -left-8 text-4xl sparkle">⭐</div>
                    <div class="absolute -top-4 -right-4 text-3xl sparkle" style="animation-delay: 0.3s;">✨</div>
                    <div class="absolute -bottom-6 -left-6 text-3xl sparkle" style="animation-delay: 0.6s;">💫</div>
                    <div class="absolute -bottom-8 -right-8 text-4xl sparkle" style="animation-delay: 0.9s;">🌟</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
