@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('content')
    <div class="min-h-screen bg-cover bg-top bg-no-repeat" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}');">
        <div class="container mx-auto p-8 pt-32">
           <div class="text-center">
            <h1 class="text-yellow-400 text-8xl font-bold transition-all relative group text-stroke-h1 mb-8">
                EL BOSQUE DE LOS<br>
                NÚMEROS PERDIDOS
            </h1>
            <p class="text-4xl text-[#7A5526] font-bold mb-8" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">Resuelve retos y devuelve la vida al bosque</p>
            <div class="flex justify-center mb-12">
                <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Abeja Sumina" class="w-120 h-120 object-contain animate-bounce-slow">
            </div>
            <div class="flex justify-center gap-6 mb-16">
                <a href="{{ route('historia') }}" class="relative text-[#FFED9A] py-4 px-12 rounded-2xl text-3xl transition-all duration-300 shadow-2xl inline-flex items-center gap-3 hover:scale-105 overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">
                    <svg class="w-16 h-16" fill="#FED32C" viewBox="0 0   20 20" stroke="#86622F" stroke-width="4">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Entra a la historia
                </a>
                
            </div>

            <!-- Sección de Categorías -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4 pb-16">
                <!-- Categoría 1: El Bosque de las Sumas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/BosqueDeLasSumas.png') }}" alt="El Bosque de las Sumas" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ayuda a Sumina a devolver la vida al bosque resolviendo divertidas sumas.</p>
                        @auth
                            <a href="{{ route('juego-sumas') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105 mt-auto" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                                Jugar
                            </a>
                        @else
                            <button onclick="alert('Debes iniciar sesión para jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Bloqueado
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Categoría 2: Ayuda a Sumina a cruzar el río -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/PuenteDeLaLogica.png') }}" alt="Cruza el río" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ayuda a Sumina a cruzar el río ordenando los números en el orden correcto, serás capaz?</p>
                        @auth
                            <div class="relative">
                                <a id="puente-link" href="{{ route('puente-logica') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed pointer-events-none" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                    <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                    <span id="puente-link-text">Bloqueado</span>
                                </a>
                                <span id="puente-badge" class="absolute -top-3 -right-3 bg-[#E91E63] text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">Termina las sumas</span>
                            </div>
                        @else
                            <button onclick="alert('Debes iniciar sesión para jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Bloqueado
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Categoría 3: Relacionar números con frutas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/ValleDeLasFrutas.png') }}" alt="Números y frutas" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ayuda a Sumina a relacionar los números con la cantidad correcta de frutas mágicas.</p>
                        @auth
                            <div class="relative">
                                <a id="valle-link" href="{{ route('valle-frutas') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed pointer-events-none" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                    <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                    <span id="valle-link-text">Bloqueado</span>
                                </a>
                                <span id="valle-badge" class="absolute -top-3 -right-3 bg-[#E91E63] text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">Termina el puente</span>
                            </div>
                        @else
                            <button onclick="alert('Debes iniciar sesión para jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Bloqueado
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Categoría 4: Recoger manzanas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/JardinDeLasRestas.png') }}" alt="Recoger manzanas" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ayuda a Sumina a recoger las manzanas correctas resolviendo restas mágicas.</p>
                        <button onclick="alert('Debes iniciar sesión para jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                            Bloqueado
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sección Conócenos -->
            <div id="conocenos" class="mt-32 mb-16 pt-20" style="scroll-margin-top: 20px;">
                <div class="max-w-6xl mx-auto px-4">
                    <h2 class="text-yellow-400 text-6xl font-bold text-center mb-8 text-stroke-h1">
                        CONÓCENOS
                    </h2>
                    
                    <!-- Texto introductorio -->
                    <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-2xl p-8 mb-12" style="border: 6px solid #D4A574;">
                        <p class="text-[#7A5526] text-2xl text-center leading-relaxed" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">
                            Somos un equipo de estudiantes apasionados por la tecnología y la educación. Este proyecto nació con el objetivo de hacer que el aprendizaje de las matemáticas sea divertido y accesible para todos los niños. 
                            <span class="font-bold">¡Conoce al equipo detrás de El Bosque de los Números Perdidos!</span>
                        </p>
                    </div>

                    <!-- Grid de miembros del equipo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Miembro 1 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:-rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <!-- Overlay amarillo al hacer hover -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/AdriG.png') }}" alt="Adrià Gómez" class="w-full h-full object-cover">
                                    <!-- Animación de brillo al pasar por encima -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Adrià Gómez</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JUEGO 1</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Responsable del diseño y desarrollo de El Bosque de las Sumas.
                                </p>
                            </div>
                        </div>

                        <!-- Miembro 2 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <!-- Overlay amarillo al hacer hover -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/VictorC.png') }}" alt="Victor Calvo" class="w-full h-full object-cover">
                                    <!-- Animación de brillo al pasar por encima -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Victor<br> Calvo</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JUEGO 2</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Creador del Puente de la Lógica y sus desafíos numéricos.
                                </p>
                            </div>
                        </div>

                        <!-- Miembro 3 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:-rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <!-- Overlay amarillo al hacer hover -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/RaulH.png') }}" alt="Raúl Hernández" class="w-full h-full object-cover">
                                    <!-- Animación de brillo al pasar por encima -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Raúl Hernández</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JUEGO 3</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Desarrollador del Valle de las Frutas y sus cantidades mágicas.
                                </p>
                            </div>
                        </div>

                        <!-- Miembro 4 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <!-- Overlay amarillo al hacer hover -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/miembro4.jpg') }}" alt="Miembro 4" class="w-full h-full object-cover">
                                    <!-- Animación de brillo al pasar por encima -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Nombre Apellido</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JUEGO 4</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Arquitecto del Jardín de las Restas y sus manzanas mágicas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>

        <!-- Footer -->
        <footer class="w-full bg-gradient-to-b from-[#2d5016] to-[#1a3d0f] py-8 mt-20" style="border-top: 4px solid #4a7c2e;">
            <div class="max-w-4xl mx-auto px-8">
                <!-- Enlaces principales -->
                <div class="flex flex-wrap justify-center items-center gap-6 mb-6">
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Contacto
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Política de Privacidad
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Términos de Servicio
                    </a>
                </div>
                
                <!-- Separador -->
                <div class="h-px bg-white rounded-full mb-5 max-w-xs mx-auto opacity-50"></div>
                
                <!-- Copyright -->
                <div class="text-center">
                    <p class="text-[#4CAF50] text-sm font-light">
                        © 2025 El Bosque de los Números Perdidos
                    </p>
                </div>
        </div>
        </footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const puenteLink = document.getElementById('puente-link');
            const puenteText = document.getElementById('puente-link-text');
            const puenteBadge = document.getElementById('puente-badge');
            
            const valleLink = document.getElementById('valle-link');
            const valleText = document.getElementById('valle-link-text');
            const valleBadge = document.getElementById('valle-badge');
            
            // Verificar si las sumas están completadas
            let sumasCompleted = false;
            let puenteCompleted = false;
            try {
                sumasCompleted = localStorage.getItem('sumasCompleted') === 'true';
                puenteCompleted = localStorage.getItem('puenteCompleted') === 'true';
            } catch (e) {
                console.log('Error leyendo localStorage:', e);
            }
            
            console.log('Sumas completadas:', sumasCompleted);
            console.log('Puente completado:', puenteCompleted);
            
            // Desbloquear Puente de la Lógica si las sumas están completas
            if (sumasCompleted && puenteLink) {
                puenteLink.classList.remove('opacity-60', 'cursor-not-allowed', 'pointer-events-none');
                puenteLink.classList.add('hover:scale-105');
                if (puenteText) puenteText.textContent = 'Jugar';
                if (puenteBadge) puenteBadge.classList.add('hidden');
            } else if (puenteLink) {
                puenteLink.addEventListener('click', function(e) {
                    if (!sumasCompleted) {
                        e.preventDefault();
                        alert('¡Completa primero el Bosque de las Sumas para desbloquear este nivel!');
                    }
                });
            }
            
            // Desbloquear Valle de las Frutas si el puente está completo
            if (puenteCompleted && valleLink) {
                valleLink.classList.remove('opacity-60', 'cursor-not-allowed', 'pointer-events-none');
                valleLink.classList.add('hover:scale-105');
                if (valleText) valleText.textContent = 'Jugar';
                if (valleBadge) valleBadge.classList.add('hidden');
            } else if (valleLink) {
                valleLink.addEventListener('click', function(e) {
                    if (!puenteCompleted) {
                        e.preventDefault();
                        alert('¡Completa primero el Puente de la Lógica para desbloquear este nivel!');
                    }
                });
            }
        });
    </script>
@endsection
