@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('title', 'El Bosque de las Sumas')

@section('body-class', 'm-0 p-0 overflow-hidden bg-cover bg-center h-screen pt-32')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite(['resources/css/menu-dropdown.css', 'resources/js/juego-sumas.js'])
<style>
    body {
        background-image: url('{{ asset('imagenes/fondobosque.jpg') }}');
    }
    @keyframes fall {
        from { transform: translateY(-100px) rotate(0deg); opacity: 1; }
        to { transform: translateY(calc(100vh + 100px)) rotate(360deg); opacity: 1; }
    }
    @keyframes pulse-success {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
<style>
    #menu-dropdown {
        background: #2F6310 !important;
        border-color: #FED32C !important;
        background-image: none !important;
    }
    #menu-dropdown button {
        background: #2F6310 !important;
        color: #fff !important;
        margin-top: 0.25rem;
    }
    #menu-dropdown button:hover {
        background: #21510b !important;
        color: #fff !important;
        box-shadow: 0 2px 8px 0 rgba(47,99,16,0.18);
    }
    #menu-dropdown #exit-btn {
        color: #FED32C !important;
    }
    #menu-dropdown #exit-btn:hover {
        color: #fff !important;
    }
</style>
@endsection

@section('content')
    <!-- Operación centrada arriba absoluta -->
    <div class="fixed top-[160px] left-0 w-full flex justify-center z-[200] pointer-events-none">
        <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl px-12 py-6 shadow-2xl bg-cover bg-blend-overlay flex items-center justify-center min-w-[320px] max-w-xl mx-auto pointer-events-auto" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
            <div id="operation" class="text-5xl font-black text-[#5A3516] text-center" style="text-shadow: 3px 3px 0 #FED32C;"></div>
        </div>
    </div>
    <!-- Header del juego con temporizador y menú -->
    <div class="fixed top-[148px] left-0 right-0 z-[100] px-10 flex justify-start items-start">
        <!-- Botón menú tres barras -->
        <button id="menu-btn" class="absolute top-0 right-0 mt-2 mr-4 z-50 focus:outline-none" style="width: 56px; height: 56px;">
            <img src="{{ asset('imagenes/menutresbarras.png') }}" alt="Menú" class="w-full h-full select-none pointer-events-auto shadow-xl" style="box-shadow: 0 6px 18px 0 rgba(0,0,0,0.35); border-radius: 16px;" draggable="false">
        </button>
        <div id="menu-dropdown" class="hidden absolute top-[60px] right-0 mt-2 mr-4 z-50 min-w-[180px] bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl shadow-2xl py-2 px-4 flex flex-col items-stretch animate-fadeIn" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
                        <!-- pointer-events-auto para permitir interacción con el menú -->
            <button id="pause-btn" class="text-xl font-bold py-2 px-4 rounded-xl transition">Pausar el juego</button>
            <button id="restart-btn" class="text-xl font-bold py-2 px-4 rounded-xl transition">Reiniciar</button>
            <button id="exit-btn" class="text-xl font-bold py-2 px-4 rounded-xl transition">Salir</button>
        </div>
        <div class="flex flex-col items-start">
            <!-- Temporizador visual -->
            <div class="flex flex-col items-start pointer-events-auto w-full">
            <div class="relative min-w-[220px] h-[80px] flex items-center">
                <img src="{{ asset('imagenes/timer.png') }}" alt="Fondo temporizador" class="absolute left-[60px] top-[9px] w-[170px] h-[62px] select-none pointer-events-none" draggable="false">
                <img src="{{ asset('imagenes/reloj.png') }}" alt="Reloj" class="absolute left-[30px] top-[-18px] w-[110px] h-[110px] z-10 select-none pointer-events-none" draggable="false">
                <span id="timer" class="relative z-20 ml-[133px] text-3xl font-black text-[#5A3516]" style="text-shadow: 2px 2px 0 #FED32C; min-width: 80px; display: inline-block;">00:00</span>
            </div>
            </div>
            <!-- Vidas -->
            <div class="mt-2 bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl p-6 shadow-2xl bg-cover bg-blend-overlay flex items-center justify-center min-w-[180px]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
                <div id="lives" class="flex gap-2 text-3xl"></div>
            </div>
            <!-- Puntuación -->
            <div class="mt-2 bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl p-6 shadow-2xl bg-cover bg-blend-overlay flex flex-col items-center min-w-[180px]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
                <div class="text-2xl font-black text-[#5A3516] my-1">Puntos: <span id="score" class="text-[#4CAF50]">0</span></div>
                <div class="text-2xl font-black text-[#5A3516] my-1">Racha: <span id="streak" class="text-[#FED32C]">0</span></div>
            </div>
        </div>
    </div>
    
    <!-- Área de juego -->
    <div id="game-area" class="fixed inset-0 z-10"></div>
    
    <!-- Feedback -->
    <div id="feedback" class="hidden fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-8xl font-black z-[1000] pointer-events-none" style="text-shadow: 5px 5px 0 #FFFFFF, -5px -5px 0 #FFFFFF, 5px -5px 0 #FFFFFF, -5px 5px 0 #FFFFFF;"></div>
    
    <!-- Modal de Victoria -->
    <div id="victory-modal" class="hidden fixed inset-0 bg-black/85 flex items-center justify-center z-[200]">
        <div class="absolute top-6 right-6 z-[210]">
            <a href="{{ route('home') }}" class="bg-transparent hover:bg-white/20 text-white font-black text-xl py-3 px-8 rounded-xl border-4 border-transparent hover:border-white inline-flex items-center gap-2 transition-all duration-300 backdrop-blur-sm hover:shadow-2xl hover:scale-105" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>
        <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-8 border-[#FED32C] rounded-3xl p-12 text-center max-w-2xl shadow-2xl bg-cover bg-blend-overlay" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); animation: fadeIn 0.5s ease-out;">
            <h2 class="text-7xl font-black mb-5 text-[#4CAF50]" style="text-shadow: 4px 4px 0 rgba(0,0,0,0.2);">¡FELICIDADES!</h2>
            <p class="text-3xl text-[#5A3516] font-bold my-4">Has devuelto la vida al Bosque</p>
            <p class="text-2xl text-[#5A3516] font-semibold my-4">Puntuación final: <span id="final-score" class="text-[#4CAF50] font-black">0</span></p>
            <a id="next-level-btn" href="{{ route('puente-logica') }}" class="bg-[#4CAF50] hover:bg-[#45A049] text-white border-4 border-[#2E7D32] py-5 px-12 text-3xl font-black rounded-2xl cursor-pointer mt-5 shadow-lg transition-all duration-300 hover:scale-105 inline-block">Siguiente Nivel</a>
        </div>
    </div>
    
    <!-- Modal de Game Over -->
    <div id="gameover-modal" class="hidden fixed inset-0 bg-black/85 flex items-center justify-center z-[200]">
        <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-8 border-[#FED32C] rounded-3xl p-12 text-center max-w-2xl shadow-2xl bg-cover bg-blend-overlay" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); animation: fadeIn 0.5s ease-out;">
            <h2 class="text-7xl font-black mb-5 text-[#E91E63]" style="text-shadow: 4px 4px 0 rgba(0,0,0,0.2);">GAME OVER</h2>
            <p class="text-3xl text-[#5A3516] font-bold my-4">¡No te rindas!</p>
            <p class="text-2xl text-[#5A3516] font-semibold my-4">Puntuación: <span id="gameover-score" class="font-black">0</span></p>
            <button onclick="restartGame()" class="bg-[#4CAF50] hover:bg-[#45A049] text-white border-4 border-[#2E7D32] py-5 px-12 text-3xl font-black rounded-2xl cursor-pointer mt-5 shadow-lg transition-all duration-300 hover:scale-105">Intentar de Nuevo</button>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Definir rutas absolutas de las rosas para JS -->
    <script>
        window.FLOWER_ROSE_PATHS = [
            "{{ asset('imagenes/rosarosa.png') }}",
            "{{ asset('imagenes/rosaazul.png') }}",
            "{{ asset('imagenes/rosaamarilla.png') }}"
        ];
        window.PUENTE_LOGICA_URL = "{{ route('puente-logica') }}";
        window.SAVE_PARTIDA_URL = "{{ route('partida.save') }}";
        document.addEventListener('DOMContentLoaded', function() {
            const nextBtn = document.getElementById('next-level-btn');
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    try { localStorage.setItem('sumasCompleted', 'true'); } catch (e) {}
                    window.location.href = window.PUENTE_LOGICA_URL || nextBtn.href || '/puente-logica';
                });
            }
        });
        // Dropdown menú lógica
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const dropdown = document.getElementById('menu-dropdown');
            let dropdownOpen = false;
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
                dropdownOpen = !dropdownOpen;
            });
            // Cerrar el dropdown al hacer click fuera
            document.addEventListener('click', function(e) {
                if (dropdownOpen && !dropdown.contains(e.target) && e.target !== menuBtn) {
                    dropdown.classList.add('hidden');
                    dropdownOpen = false;
                }
            });
            // Botones del menú
            document.getElementById('pause-btn').addEventListener('click', function() {
                // Aquí lógica para pausar el juego
                alert('Juego pausado (implementa lógica)');
                dropdown.classList.add('hidden');
                dropdownOpen = false;
            });
            document.getElementById('restart-btn').addEventListener('click', function() {
                if (typeof restartGame === 'function') restartGame();
                dropdown.classList.add('hidden');
                dropdownOpen = false;
            });
            document.getElementById('exit-btn').addEventListener('click', function() {
                window.location.href = "{{ route('home') }}"; // Redirige a landing
            });
        });
    </script>
@endsection
