@extends(Auth::check() ? 'landing-auth-header-ca' : 'landing-header-ca')

@section('content')
    <div class="min-h-screen bg-cover bg-top bg-no-repeat" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}');">
        <div class="container mx-auto p-8 pt-32">
           <div class="text-center">
            <h1 class="text-yellow-400 text-8xl font-bold transition-all relative group text-stroke-h1 mb-8">
                EL BOSC DELS<br>
                NÚMEROS PERDUTS
            </h1>
            <p class="text-4xl text-[#7A5526] font-bold mb-8" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">Resol reptes i torna la vida al bosc</p>
            <div class="flex justify-center mb-12">
                <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Abella Sumina" class="w-120 h-120 object-contain animate-bounce-slow">
            </div>
            <div class="flex justify-center gap-6 mb-16">
                <a href="{{ route('historia.ca') }}" class="relative text-[#FFED9A] py-4 px-12 rounded-2xl text-3xl transition-all duration-300 shadow-2xl inline-flex items-center gap-3 hover:scale-105 overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">
                    <svg class="w-16 h-16" fill="#FED32C" viewBox="0 0   20 20" stroke="#86622F" stroke-width="4">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Entra a la història
                </a>
                
            </div>

            <!-- Secció de Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4 pb-16">
                <!-- Categoria 1: El Bosc de les Sumes -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/BosqueDeLasSumas.png') }}" alt="El Bosc de les Sumes" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ajuda a Sumina a tornar la vida al bosc resolent divertides sumes.</p>
                        @auth
                            <a href="{{ route('juego-sumas') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105 mt-auto" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                                Jugar
                            </a>
                        @else
                            <button onclick="alert('Has d\'iniciar sessió per jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Bloquejat
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Categoria 2: Ajuda a Sumina a creuar el riu -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/PuenteDeLaLogica.png') }}" alt="Creua el riu" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ajuda a Sumina a creuar el riu ordenant els números en l'ordre correcte, seràs capaç?</p>
                        @auth
                            <div class="relative">
                                <a id="puente-link" href="{{ route('puente-logica') }}" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed pointer-events-none" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                    <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                    <span id="puente-link-text">Bloquejat</span>
                                </a>
                                <span id="puente-badge" class="absolute -top-3 -right-3 bg-[#E91E63] text-white text-xs font-black px-3 py-1 rounded-full shadow-lg">Acaba les sumes</span>
                            </div>
                        @else
                            <button onclick="alert('Has d\'iniciar sessió per jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                                <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                Bloquejat
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Categoria 3: Relacionar números amb fruites -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/ValleDeLasFrutas.png') }}" alt="Números i fruites" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ajuda a Sumina a relacionar els números amb la quantitat correcta de fruites màgiques.</p>
                        <button onclick="alert('Has d\'iniciar sessió per jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                            Bloquejat
                        </button>
                    </div>
                </div>

                <!-- Categoria 4: Recollir pomes -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 flex flex-col" style="border: 4px solid #D4A574;">
                    <div class="p-6 flex flex-col flex-grow">
                        <img src="{{ asset('imagenes/JardinDeLasRestas.png') }}" alt="Recollir pomes" class="w-full h-64 object-contain mb-4" style="border-radius: 25px;">
                        <p class="text-[#FED32C] text-lg mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">Ajuda a Sumina a recollir les pomes correctes resolent restes màgiques.</p>
                        <button onclick="alert('Has d\'iniciar sessió per jugar')" class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 mt-auto opacity-60 cursor-not-allowed" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                            Bloquejat
                        </button>
                    </div>
                </div>
            </div>

            <!-- Secció Coneix-nos -->
            <div id="conocenos" class="mt-32 mb-16 pt-20" style="scroll-margin-top: 20px;">
                <div class="max-w-6xl mx-auto px-4">
                    <h2 class="text-yellow-400 text-6xl font-bold text-center mb-8 text-stroke-h1">
                        CONEIX-NOS
                    </h2>
                    
                    <!-- Text introductori -->
                    <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-2xl p-8 mb-12" style="border: 6px solid #D4A574;">
                        <p class="text-[#7A5526] text-2xl text-center leading-relaxed" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">
                            Som un equip d'estudiants apassionats per la tecnologia i l'educació. Aquest projecte va néixer amb l'objectiu de fer que l'aprenentatge de les matemàtiques sigui divertit i accessible per a tots els nens.
                            <span class="font-bold">Coneix l'equip darrere d'El Bosc dels Números Perduts!</span>
                        </p>
                    </div>

                    <!-- Grid de membres de l'equip -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Membre 1 -->
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
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JOC 1</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Responsable del disseny i desenvolupament d'El Bosc de les Sumes.
                                </p>
                            </div>
                        </div>

                        <!-- Membre 2 -->
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
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JOC 2</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Creador del Pont de la Lògica i els seus desafiaments numèrics.
                                </p>
                            </div>
                        </div>

                        <!-- Membre 3 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:-rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/miembro3.jpg') }}" alt="Membre 3" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Nom Cognom</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JOC 3</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Desenvolupador de la Vall de les Fruites i les seves quantitats màgiques.
                                </p>
                            </div>
                        </div>

                        <!-- Membre 4 -->
                        <div class="group bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-500 hover:rotate-2 cursor-pointer relative" style="border: 4px solid #D4A574;">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#FFD700]/20 to-[#FFA500]/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                            
                            <div class="p-8 flex flex-col items-center relative z-20">
                                <div class="w-64 h-64 mb-6 rounded-full overflow-hidden relative transform group-hover:scale-110 transition-all duration-500" style="border: 5px solid #86622F; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                                    <img src="{{ asset('imagenes/miembro4.jpg') }}" alt="Membre 4" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </div>
                                <h3 class="text-[#7A5526] text-3xl font-bold mb-3 text-center group-hover:text-[#5A3516] transition-colors duration-300 group-hover:scale-105 transform">Nom Cognom</h3>
                                <div class="relative mb-4 transform group-hover:scale-110 transition-all duration-300">
                                    <div class="relative px-8 py-3 rounded-2xl overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; border: 3px solid #86622F; box-shadow: 0 6px 15px rgba(0,0,0,0.3);">
                                        <div class="absolute inset-0 bg-gradient-to-r from-[#FFD700]/30 via-transparent to-[#FFD700]/30 group-hover:animate-pulse"></div>
                                        <p class="relative text-[#FFED9A] text-lg font-black tracking-wide" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill; text-shadow: 0 4px 8px rgba(0,0,0,0.3);">CREADOR JOC 4</p>
                                    </div>
                                </div>
                                <p class="text-[#7A5526] text-lg text-center leading-relaxed font-medium group-hover:text-[#5A3516] transition-colors duration-300">
                                    Arquitecte del Jardí de les Restes i les seves pomes màgiques.
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
                <!-- Enllaços principals -->
                <div class="flex flex-wrap justify-center items-center gap-6 mb-6">
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Contacte
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Política de Privacitat
                    </a>
                    <span class="text-white text-lg">•</span>
                    <a href="#" class="text-[#4CAF50] text-sm font-normal hover:text-gray-200 transition-colors duration-300 hover:scale-105 transform">
                        Termes de Servei
                    </a>
                </div>
                
                <!-- Separador -->
                <div class="h-px bg-white rounded-full mb-5 max-w-xs mx-auto opacity-50"></div>
                
                <!-- Copyright -->
                <div class="text-center">
                    <p class="text-[#4CAF50] text-sm font-light">
                        © 2025 El Bosc dels Números Perduts
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
            
            // Verificar si les sumes estan completades
            let unlocked = false;
            try {
                unlocked = localStorage.getItem('sumasCompleted') === 'true';
            } catch (e) {
                console.log('Error llegint localStorage:', e);
                unlocked = false;
            }
            
            console.log('Pont desbloquejat:', unlocked);
            
            // Si està desbloquejat, habilitar l'enllaç
            if (unlocked && puenteLink) {
                puenteLink.classList.remove('opacity-60', 'cursor-not-allowed', 'pointer-events-none');
                puenteLink.classList.add('hover:scale-105');
                if (puenteText) puenteText.textContent = 'Jugar';
                if (puenteBadge) puenteBadge.classList.add('hidden');
            } else if (puenteLink) {
                // Si està bloquejat, prevenir navegació i mostrar missatge
                puenteLink.addEventListener('click', function(e) {
                    if (!unlocked) {
                        e.preventDefault();
                        alert('Completa primer el Bosc de les Sumes per desbloquejar aquest nivell!');
                    }
                });
            }
        });
    </script>
@endsection
