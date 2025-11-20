@extends('landing-header')

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
            <div class="flex justify-center mb-16">
                <a href="#" class="relative text-[#FFED9A] py-4 px-12 rounded-2xl text-3xl transition-all duration-300 shadow-2xl inline-flex items-center gap-3 hover:scale-105 overflow-hidden" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">
                    <svg class="w-16 h-16" fill="#FED32C" viewBox="0 0   20 20" stroke="#86622F" stroke-width="4">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Entra a la historia
                </a>
            </div>

            <!-- Sección de Categorías -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4 pb-16">
                <!-- Categoría 1: El Bosque de las Sumas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" style="border: 4px solid #D4A574;">
                    <div class="p-6">
                        <img src="{{ asset('imagenes/BosqueDeLasSumas.png') }}" alt="El Bosque de las Sumas" class="w-full h-48 rounded-2xl mb-4" style="object-fit: cover; object-position: 0% 0%;">
                        <h3 class="text-[#7A5526] text-xl font-bold mb-2 text-center">El Bosque<br>de las Sumas</h3>
                        <p class="text-[#FED32C] text-xs font-bold mb-4 text-center" style="-webkit-text-stroke: 2px #86622F; paint-order: stroke fill;">Ayuda a Sumina a devolver la vida al bosque resolviendo divertidas sumas.</p>
                        <button class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                            Jugar
                        </button>
                    </div>
                </div>

                <!-- Categoría 2: Ayuda a Sumina a cruzar el río -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" style="border: 4px solid #D4A574;">
                    <div class="p-6">
                        <img src="{{ asset('imagenes/categoria2.png') }}" alt="Cruza el río" class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-[#FED32C] text-2xl mb-2 text-center" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;"></h3>
                        <p class="text-[#FED32C] text-sm mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">ordenando los números en el orden correcto</p>
                        <button class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                            Jugar
                        </button>
                    </div>
                </div>

                <!-- Categoría 3: Relacionar números con frutas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" style="border: 4px solid #D4A574;">
                    <div class="p-6">
                        <img src="{{ asset('imagenes/categoria3.png') }}" alt="Números y frutas" class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-[#FED32C] text-2xl  mb-2 text-center" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;"></h3>
                        <p class="text-[#FED32C] text-sm mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">con la cantidad correcta de frutas mágicas.</p>
                        <button class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                            Jugar
                        </button>
                    </div>
                </div>

                <!-- Categoría 4: Recoger manzanas -->
                <div class="bg-gradient-to-b from-[#FFEAA7] to-[#F9D68A] rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" style="border: 4px solid #D4A574;">
                    <div class="p-6">
                        <img src="{{ asset('imagenes/categoria4.png') }}" alt="Recoger manzanas" class="w-full h-48 object-cover rounded-2xl mb-4">
                        <h3 class="text-[#FED32C] text-2xl mb-2 text-center" style="-webkit-text-stroke: 6px #86622F; paint-order: stroke fill;"></h3>
                        <p class="text-[#FED32C] text-sm mb-4 text-center" style="-webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">correctas resolviendo restas mágicas.</p>
                        <button class="w-full text-[#FFED9A] font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); background-size: cover; background-position: center; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); -webkit-text-stroke: 3px #86622F; paint-order: stroke fill;">
                            <svg class="w-6 h-6" fill="#FED32C" viewBox="0 0 20 20" stroke="#86622F" stroke-width="2">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                            Jugar
                        </button>
                    </div>
                </div>
            </div>
           </div>
        </div>

        <!-- Footer -->
        <footer class="relative bg-cover bg-center py-8" style="background-image: url('{{ asset('imagenes/fondolanding.png') }}');">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10 container mx-auto px-4">
                <div class="flex justify-center items-center gap-16 text-white text-lg">
                    <a href="#" class="hover:text-[#FED32C] transition-colors duration-300">Contact</a>
                    <a href="#" class="hover:text-[#FED32C] transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-[#FED32C] transition-colors duration-300">Terms of service</a>
                </div>
            </div>
        </footer>
    </div>
@endsection
