@extends(Auth::check() ? 'landing-auth-header-en' : 'landing-header-en')

@section('content')
    <div class="min-h-screen bg-cover bg-top bg-no-repeat" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}');">
        <div class="container mx-auto p-8 pt-32">
           <div class="text-center">
            <h1 class="text-yellow-400 text-8xl font-bold transition-all relative group text-stroke-h1 mb-8">
                THE FOREST OF<br>
                LOST NUMBERS
            </h1>
            <p class="text-4xl text-[#7A5526] font-bold mb-8" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">Solve challenges and bring life back to the forest</p>
            <div class="flex justify-center mb-12">
                <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Bee Sumina" class="w-120 h-120 object-contain animate-bounce-slow">
            </div>
            <div class="flex justify-center gap-6 mb-16">
                <a href="{{ route('historia.en') }}" class="relative text-[#FFED9A] py-4 px-12 rounded-2xl text-3xl transition-all duration-300 shadow-2xl inline-flex items-center gap-3 hover:scale-105 overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">
                    <svg class="w-16 h-16" fill="#FED32C" viewBox="0 0   20 20" stroke="#86622F" stroke-width="4">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Enter the Story
                </a>
                
            </div>

            <!-- Categories Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4 pb-16">
                <!-- Category 1: Addition Forest -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/BosqueDeLasSumas.png') }}" alt="Addition Forest" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Help Sumina bring life back to the forest by solving fun additions.</p>
                        @auth
                            <a href="{{ route('juego-sumas') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105 mt-auto" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                                Play
                            </a>
                        @else
                            <button onclick="alert('You must log in to play')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Locked
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Category 2: Help Sumina cross the river -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/PuenteDeLaLogica.png') }}" alt="Cross the river" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Help Sumina cross the river by ordering the numbers correctly. Can you do it?</p>
                        @auth
                            <div class="relative">
                                <a id="puente-link" href="{{ route('puente-logica') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed pointer-events-none" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                    <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                    <span id="puente-link-text">Locked</span>
                                </a>
                                <span id="puente-badge" class="absolute -top-3 -right-3 bg-[#E91E63] text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">Finish additions</span>
                            </div>
                        @else
                            <button onclick="alert('You must log in to play')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Locked
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Category 3: Match numbers with fruits -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/ValleDeLasFrutas.png') }}" alt="Numbers and fruits" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Help Sumina match numbers with the correct quantity of magical fruits.</p>
                        @auth
                            <div class="relative">
                                <a id="valle-link" href="{{ route('valle-frutas') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed pointer-events-none" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                    <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                    <span id="valle-link-text">Locked</span>
                                </a>
                                <span id="valle-badge" class="absolute -top-3 -right-3 bg-[#E91E63] text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">Finish bridge</span>
                            </div>
                        @else
                            <button onclick="alert('You must log in to play')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Locked
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Category 4: Pick apples -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/JardinDeLasRestas.png') }}" alt="Pick apples" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Help Sumina pick the correct apples by solving magical subtractions.</p>
                        <button onclick="alert('You must log in to play')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                            Locked
                        </button>
                    </div>
                </div>
            </div>

            <!-- About Us Section -->
            <div id="conocenos" class="mt-32 mb-16 pt-20" style="scroll-margin-top: 20px;">
                <div class="max-w-6xl mx-auto px-4">
                    <h2 class="text-yellow-400 text-6xl font-bold text-center mb-8 text-stroke-h1">
                        ABOUT US
                    </h2>
                    
                    <!-- Introductory text -->
                    <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-2xl p-8 mb-12" style="border: 6px solid #D4A574;">
                        <p class="text-[#7A5526] text-2xl text-center leading-relaxed" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">
                            We are a team of students passionate about technology and education. This project was born with the goal of making math learning fun and accessible for all children.
                            <span class="font-bold">Meet the team behind The Forest of Lost Numbers!</span>
                        </p>
                    </div>

                    <!-- Team members grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Member 1 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:-rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/AdriG.png') }}" alt="Adrià Gómez" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Adrià Gómez</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">GAME 1 CREATOR</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Responsible for the design and development of The Addition Forest.
                                </p>
                            </div>
                        </div>

                        <!-- Member 2 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/VictorC.png') }}" alt="Victor Calvo" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Victor<br> Calvo</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">GAME 2 CREATOR</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Creator of The Logic Bridge and its number challenges.
                                </p>
                            </div>
                        </div>

                        <!-- Member 3 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:-rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/RaulH.png') }}" alt="Raúl Hernández" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Raúl Hernández</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">GAME 3 CREATOR</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Developer of The Fruit Valley and its magical quantities.
                                </p>
                            </div>
                        </div>

                        <!-- Member 4 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/miembro4.jpg') }}" alt="Member 4" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Name Surname</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">GAME 4 CREATOR</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Architect of The Subtraction Garden and its magical apples.
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
                <!-- Main links -->
                <div class="flex flex-wrap justify-center items-center gap-6 mb-6">
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Contact
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Privacy Policy
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Terms of Service
                    </a>
                </div>
                
                <!-- Separator -->
                <div class="h-px bg-white rounded-full mb-5 max-w-xs mx-auto opacity-50"></div>
                
                <!-- Copyright -->
                <div class="text-center">
                    <p class="text-[#4CAF50] text-sm font-light">
                        © 2025 The Forest of Lost Numbers
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
            
            // Check if additions and bridge are completed
            let sumasCompleted = false;
            let puenteCompleted = false;
            try {
                sumasCompleted = localStorage.getItem('sumasCompleted') === 'true';
                puenteCompleted = localStorage.getItem('puenteCompleted') === 'true';
            } catch (e) {
                console.log('Error reading localStorage:', e);
            }
            
            console.log('Additions completed:', sumasCompleted);
            console.log('Bridge completed:', puenteCompleted);
            
            // Unlock Logic Bridge if additions are complete
            if (sumasCompleted && puenteLink) {
                puenteLink.classList.remove('opacity-60', 'cursor-not-allowed', 'pointer-events-none');
                puenteLink.classList.add('hover:scale-105');
                if (puenteText) puenteText.textContent = 'Play';
                if (puenteBadge) puenteBadge.classList.add('hidden');
            } else if (puenteLink) {
                puenteLink.addEventListener('click', function(e) {
                    if (!sumasCompleted) {
                        e.preventDefault();
                        alert('Complete The Addition Forest first to unlock this level!');
                    }
                });
            }
            
            // Unlock Fruit Valley if bridge is complete
            if (puenteCompleted && valleLink) {
                valleLink.classList.remove('opacity-60', 'cursor-not-allowed', 'pointer-events-none');
                valleLink.classList.add('hover:scale-105');
                if (valleText) valleText.textContent = 'Play';
                if (valleBadge) valleBadge.classList.add('hidden');
            } else if (valleLink) {
                valleLink.addEventListener('click', function(e) {
                    if (!puenteCompleted) {
                        e.preventDefault();
                        alert('Complete The Logic Bridge first to unlock this level!');
                    }
                });
            }
        });
    </script>
@endsection
