@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('content')
    <style>
        @keyframes float-gentle {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        @keyframes slide-fade {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes reveal {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(254, 211, 44, 0.3); }
            50% { box-shadow: 0 0 40px rgba(254, 211, 44, 0.6); }
        }
        .timeline-dot {
            position: relative;
        }
        .timeline-dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background: inherit;
            border-radius: inherit;
            transform: translate(-50%, -50%);
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        @keyframes ping {
            75%, 100% {
                transform: translate(-50%, -50%) scale(1.5);
                opacity: 0;
            }
        }
    </style>

    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}');">
        <div class="container mx-auto p-8 pt-32">
            <div class="text-center">
                
                <!-- Hero Section -->
                <div class="text-center mb-12 relative">
                    <h1 class="text-yellow-400 text-8xl font-bold transition-all relative group text-stroke-h1 mb-8">
                        LA HISTORIA
                    </h1>
                    <p class="text-4xl text-[#7A5526] font-bold mb-8" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">Descubre el origen de esta mágica aventura</p>
                </div>

                <!-- Timeline Container -->
                <div class="relative">
                    <!-- Vertical Line (desktop) -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-[#D4A574] via-[#FED32C] to-[#D4A574] opacity-40"></div>

                    <!-- Chapter 1 -->
                    <div class="relative mb-16 group" style="animation: reveal 0.8s ease-out;">
                        <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                            <!-- Content -->
                            <div class="md:w-5/12 md:text-right md:pr-16">
                                <div class="inline-block bg-gradient-to-br from-[#4CAF50] to-[#45A049] px-6 py-2 rounded-full mb-4 shadow-lg">
                                    <span class="text-white font-black text-sm tracking-wider">CAPÍTULO I</span>
                                </div>
                                <h2 class="text-5xl md:text-6xl font-bold mb-3 text-[#FED32C]" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;">
                                    El Bosque Encantado
                                </h2>
                                <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] backdrop-blur-xl rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                    <p class="text-[#5A3516] text-xl leading-relaxed mb-2 font-semibold">
                                        Hace mucho tiempo existía un <span class="text-[#FED32C]" style="-webkit-text-stroke: 1px #86622F;">    Bosque Mágico</span> lleno de vida y color. Los árboles brillaban con luz dorada, las flores cantaban melodías dulces.
                                    </p>
                                    <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                        En él vivía <span class="text-[#FED32C]" style="-webkit-text-stroke: 1px #86622F;">Sumina</span>, una abeja guardiana que protegía los números mágicos del bosque.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Image -->
                            <div class="md:w-5/12 md:pl-16">
                                <div class="relative group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-br from-[#FED32C] to-[#4CAF50] rounded-3xl blur-2xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                    <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Sumina" class="relative w-full max-w-md mx-auto rounded-3xl" style="animation: float-gentle 4s ease-in-out infinite; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4));">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter 2 -->
                    <div class="relative mb-16 group" style="animation: reveal 0.8s ease-out 0.2s backwards;">
                        <div class="flex flex-col md:flex-row-reverse items-center gap-8 md:gap-12">
                            <!-- Content -->
                            <div class="md:w-5/12 md:pl-16">
                                <div class="inline-block bg-gradient-to-br from-[#4CAF50] to-[#45A049] px-6 py-2 rounded-full mb-4 shadow-lg">
                                    <span class="text-[#FFFBE9] font-black text-sm tracking-wider">CAPÍTULO II</span>
                                </div>
                                <h2 class="text-5xl md:text-6xl font-bold mb-3 text-[#FED32C]" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;">
                                    La Tragedia
                                </h2>
                                <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] backdrop-blur-xl rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                    <p class="text-[#5A3516] text-xl leading-relaxed mb-2 font-semibold">
                                        Una mañana, Sumina despertó y notó que algo terrible había sucedido...
                                    </p>
                                    <p class="text-[#5A3516] text-xl leading-relaxed mb-2 font-semibold">
                                        <span class="text-[#FED32C]" style="-webkit-text-stroke: 1px #86622F;">¡Los números mágicos habían desaparecido!</span>
                                    </p>
                                    <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                        Sin ellos, el bosque perdió su magia. Los árboles dejaron de brillar, las flores dejaron de cantar.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter 3 -->
                    <div class="relative mb-16 group" style="animation: reveal 0.8s ease-out 0.4s backwards;">
                        <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                            <!-- Content -->
                            <div class="md:w-5/12 md:text-right md:pr-16">
                                <div class="inline-block bg-gradient-to-br from-[#4CAF50] to-[#45A049] px-6 py-2 rounded-full mb-4 shadow-lg">
                                    <span class="text-white font-black text-sm tracking-wider">CAPÍTULO III</span>
                                </div>
                                <h2 class="text-5xl md:text-6xl font-bold mb-3 text-[#FED32C]" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;">
                                    Tu Misión
                                </h2>
                                <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] backdrop-blur-xl rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                    <p class="text-[#5A3516] text-xl leading-relaxed mb-2 font-semibold">
                                        Sumina necesita tu ayuda para encontrar los números perdidos y restaurar la magia del bosque.
                                    </p>
                                    <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                        <span class="text-[#FED32C]" style="-webkit-text-stroke: 1px #86622F;">Resuelve acertijos matemáticos</span>, ordena números, relaciona cantidades y completa operaciones para recuperar la magia.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Image -->
                            <div class="md:w-5/12 md:pl-16">
                                <div class="relative group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0  rounded-full blur-3xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                    <img src="{{ asset('imagenes/logojuego.png') }}" alt="Logo" class="relative w-64 h-64 mx-auto" style="filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4));">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Game Zones Section -->
                    <div class="relative mt-16 mb-12" style="animation: reveal 0.8s ease-out 0.6s backwards;">
                        <div class="text-center mb-8">
                            <h2 class="text-yellow-400 text-6xl font-bold mb-4 text-stroke-h1">
                                Explora el Bosque
                            </h2>
                            <p class="text-4xl text-[#7A5526] font-bold mb-8" style="-webkit-text-stroke: 3px #FFFFFF; paint-order: stroke fill;">Cuatro desafíos únicos te esperan</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Zone 1 -->
                            <div class="group relative bg-gradient-to-br from-[#FFE5B4] to-[#FFEAA7] rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl hover:shadow-yellow-400/50 hover:scale-[1.02] transition-all duration-500 cursor-pointer" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-br from-[#4CAF50] to-[#45A049] rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                            1
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-[#5A3516] text-3xl font-black mb-2">El Bosque de las Sumas</h3>
                                        <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                            Resuelve operaciones de suma para devolver la vida a los árboles mágicos del bosque.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Zone 2 -->
                            <div class="group relative bg-gradient-to-br from-[#FFE5B4] to-[#FFEAA7] rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl hover:shadow-yellow-400/50 hover:scale-[1.02] transition-all duration-500 cursor-pointer" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-br from-[#2196F3] to-[#1976D2] rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                            2
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-[#5A3516] text-3xl font-black mb-2">El Puente de la Lógica</h3>
                                        <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                            Ordena correctamente los números para cruzar el río y continuar tu aventura.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Zone 3 -->
                            <div class="group relative bg-gradient-to-br from-[#FFE5B4] to-[#FFEAA7] rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl hover:shadow-yellow-400/50 hover:scale-[1.02] transition-all duration-500 cursor-pointer" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-br from-[#FF9800] to-[#F57C00] rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                            3
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-[#5A3516] text-3xl font-black mb-2">El Valle de las Frutas</h3>
                                        <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                            Relaciona números con las cantidades correctas de frutas mágicas del valle.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Zone 4 -->
                            <div class="group relative bg-gradient-to-br from-[#FFE5B4] to-[#FFEAA7] rounded-2xl p-5 border-4 border-yellow-400 shadow-2xl hover:shadow-yellow-400/50 hover:scale-[1.02] transition-all duration-500 cursor-pointer" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-blend-mode: overlay;">
                                <div class="flex items-start gap-4 relative z-10">
                                    <div class="flex-shrink-0">
                                        <div class="w-14 h-14 bg-gradient-to-br from-[#E91E63] to-[#C2185B] rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                            4
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-[#5A3516] text-3xl font-black mb-2">El Jardín de las Restas</h3>
                                        <p class="text-[#5A3516] text-xl leading-relaxed font-semibold">
                                            Resuelve operaciones de resta para recoger las manzanas correctas del jardín.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center mt-12 mb-12" style="animation: reveal 0.8s ease-out 0.8s backwards;">
                    <a href="{{ route('home') }}" class="relative text-[#FFED9A] py-4 px-12 rounded-2xl text-3xl transition-all duration-300 shadow-2xl inline-flex items-center gap-3 hover:scale-105 overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">
                        <svg class="w-16 h-16" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="4">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                        Comenzar la Aventura
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w-full bg-gradient-to-b from-[#2d5016] to-[#1a3d0f] py-8 mt-16" style="border-top: 4px solid #4a7c2e;">
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
@endsection
