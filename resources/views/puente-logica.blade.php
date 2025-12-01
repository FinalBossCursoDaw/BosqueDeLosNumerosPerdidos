@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('title', 'Puente de la Lógica')

@section('body-class', 'm-0 p-0 overflow-hidden bg-cover bg-center h-screen pt-32')

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite(['resources/css/menu-dropdown.css', 'resources/js/puente-logica.js'])
<style>
    body {
        background-image: url('{{ asset('imagenes/fondopuente.jpg') }}');
    }
    .stone-draggable {
        cursor: grab;
        transition: transform 0.2s;
    }
    .stone-draggable.dragging {
        opacity: 0.7;
        transform: scale(1.1);
        z-index: 100;
    }
    .stone-wrong {
        animation: shake 0.3s;
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-8px); }
        75% { transform: translateX(8px); }
    }
    #result-message {
        padding: 0;
        border: none;
        background: transparent;
        box-shadow: none;
        color: #FFED9A;
        text-shadow: 2px 2px 0 #3D280C, -2px -2px 0 rgba(0,0,0,0.15);
        -webkit-text-stroke: 6px #3D280C;
        paint-order: stroke fill;
        letter-spacing: 1px;
        opacity: 1;
        transition: none;
    }
    #result-message:hover {
        transform: none;
        opacity: 1;
    }
    #result-message.result-success {
        color: #C6FFB8;
        text-shadow: 2px 2px 0 #2E7D32, -2px -2px 0 rgba(0,0,0,0.12);
        -webkit-text-stroke: 6px #21510b;
    }
    #result-message.result-error {
        color: #FFD166;
        text-shadow: 2px 2px 0 #7A1B21, -2px -2px 0 rgba(0,0,0,0.12);
        -webkit-text-stroke: 6px #7A1B21;
    }
    /* Mensaje de cambio de etapa */
    #stage-message {
        position: fixed;
        top: 22%;
        left: 50%;
        transform: translateX(-50%) scale(0.95);
        padding: 18px 28px;
        background: linear-gradient(135deg, #FFEAA7 0%, #F9D68A 50%, #F4C55B 100%);
        border: 6px solid #FED32C;
        border-radius: 22px;
        box-shadow: 0 16px 32px rgba(0,0,0,0.3), inset 0 0 0 6px rgba(134, 98, 47, 0.28);
        color: #5A3516;
        font-size: 1.4rem;
        font-weight: 900;
        letter-spacing: 1px;
        text-shadow: 2px 2px 0 #FED32C;
        z-index: 300;
        opacity: 0;
        pointer-events: none;
    }
    .stage-toast-show {
        animation: stagePop 4s ease forwards;
    }
    @keyframes stagePop {
        0% { opacity: 0; transform: translate(-50%, -10px) scale(0.9); }
        20% { opacity: 1; transform: translate(-50%, 0) scale(1.04); }
        80% { opacity: 1; transform: translate(-50%, 0) scale(1); }
        100% { opacity: 0; transform: translate(-50%, -8px) scale(0.98); }
    }
    /* Modal de victoria */
    .modal-wood {
        background: linear-gradient(135deg, #FFEAA7 0%, #F9D68A 45%, #F4C55B 100%);
        border: 8px solid #FED32C;
        border-radius: 26px;
        box-shadow: 0 18px 36px rgba(0,0,0,0.35), inset 0 0 0 8px rgba(134,98,47,0.26);
        background-image: url('{{ asset('imagenes/header-wood.png') }}');
        background-size: cover;
        background-blend-mode: overlay;
    }
</style>
@endsection

@section('content')


    <div class="fixed top-[148px] left-0 right-0 z-[100] px-10 flex justify-between items-start">
        <div class="flex items-center gap-4 justify-center w-full mx-auto">

            <div class="relative flex items-center justify-center w-[1500px] ">
                <img src="{{ asset('imagenes/header-wood.png') }}" alt="Fondo madera"
                    class="absolute left-1/2 top-[75%] -translate-x-1/2 -translate-y-1/2 z-[1] w-[550px] h-[120px] object-cover rounded-[18px] pointer-events-none select-none"
                    draggable="false">
                                <div class="relative mt-8 px-2 py-3 rounded-[20px] bg-[#2E7D32] border-[7px] border-[#1C5B20] flex items-center justify-center w-[450px] min-h-[20px] z-[2]">
                    <span class="text-[#FED32C] text-2xl md:text-3xl font-black tracking-wide" style="text-shadow: 2px 2px 0 #86622F; -webkit-text-stroke: 6px #86622F; paint-order: stroke fill;">PUENTE DE LA LOGICA</span>
                </div>
            </div>
        </div>
        <button id="menu-btn" class="mt-2 mr-4 z-50 focus:outline-none" style="width: 56px; height: 56px;">
            <img src="{{ asset('imagenes/menutresbarras.png') }}" alt="Menú" class="w-full h-full select-none pointer-events-auto ">
        </button>
        <div id="menu-dropdown" class="hidden absolute top-[60px] right-0 mt-2 mr-4 z-50 min-w-[180px] bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl shadow-2xl py-2 px-4 flex flex-col items-stretch animate-fadeIn" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
            <button id="restart-btn" class="text-xl font-bold py-2 px-4 rounded-xl transition">Reiniciar</button>
            <button id="exit-btn" class="text-xl font-bold py-2 px-4 rounded-xl transition">Salir</button>
        </div>
    </div>
        <div class="fixed top-40 left-6 z-50 flex flex-col items-start gap-2">
            <!-- Temporizador visual -->
            <div class="flex flex-col items-start pointer-events-auto w-full">
                <div class="relative min-w-[220px] h-[80px] flex items-center">
                    <img src="{{ asset('imagenes/timer.png') }}" alt="Fondo temporizador" class="absolute left-[30px] top-[9px] w-[170px] h-[62px] select-none pointer-events-none" draggable="false">
                    <img src="{{ asset('imagenes/reloj.png') }}" alt="Reloj" class="absolute left-[0px] top-[-18px] w-[110px] h-[110px] z-10 select-none pointer-events-none" draggable="false">
                    <span id="timer" class="relative z-20 ml-[100px] text-3xl font-black text-[#5A3516]" style="text-shadow: 2px 2px 0 #FED32C; min-width: 80px; display: inline-block;">00:00</span>
                </div>
            </div>
            <!-- Vidas -->
            <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl p-6 shadow-2xl bg-cover bg-blend-overlay flex items-center justify-center min-w-[180px]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
                <div id="lives" class="flex gap-2 text-3xl">
                     <div class="text-2xl font-black text-[#5A3516] my-1">Etapa: <span id="stage-display" class="text-[#5A3516]">1/3</span></div>
                </div>
            </div>
            <!-- Puntuación -->
            <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-4 border-[#FED32C] rounded-2xl p-6 shadow-2xl bg-cover bg-blend-overlay flex flex-col items-center min-w-[180px]" style="background-image: url('{{ asset('imagenes/header-wood.png') }}');">
                <div class="text-2xl font-black text-[#5A3516] my-1">Errores: <span id="error-count" class="text-[#D52410]">0</span></div>
                
            </div>
        </div>
        <div class="flex flex-col items-center justify-center h-full pt-32">
        <img src="{{ asset('imagenes/abeja-sunima-derecha.png') }}" alt="Abeja" class="absolute left-[270px] bottom-[400px] w-[200px] h-[180px] z-[10] select-none pointer-events-none drop-shadow-2xl animate-bounce-slow" draggable="false">
        <div id="stones-row" class="flex gap-6 mb-8 mt-72"></div>
        <div class="flex flex-row items-center justify-center mb-8 gap-0 mt-24">
            <div class="flex items-center bg-[#553711] border-4 border-[#331D00] rounded-2xl px-8 py-4 shadow-xl text-2xl  text-[#FFED9A]">
                <span class="mr-8" style="-webkit-text-stroke: 8px #3D280C; paint-order: stroke fill;"><span class="">ORDENA LAS PIEDRAS</span><br><span id="order-direction" style="-webkit-text-stroke: 8px #3D280C; paint-order: stroke fill;">DEL 1 AL 9</span></span>
                <button id="check-btn" class="ml-4 relative flex items-center justify-center px-8 py-2 text-xl font-black text-[#FFED9A] rounded-xl shadow-lg border-2 border-[#A97B3B] focus:outline-none transition-all duration-300 hover:scale-105"
                    style="background: url('{{ asset('imagenes/header-wood.png') }}') center/cover no-repeat; min-width: 160px; min-height: 48px;">
                    <span class="drop-shadow-lg" style="-webkit-text-stroke: 8px #86622F; paint-order: stroke fill;">COMPROBAR</span>
                </button>
            </div>
        </div>
        <div id="result-message" class="mt-6 text-3xl font-black"></div>
        <div id="stage-message" aria-live="polite"></div>
    </div>
    <!-- Modal de victoria -->
    <div id="victory-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-[400] px-4">
        <div class="absolute top-6 right-6 z-[410]">
            <a href="{{ route('home') }}" class="bg-transparent hover:bg-white/20 text-white font-black text-xl py-3 px-8 rounded-xl border-4 border-transparent hover:border-white inline-flex items-center gap-2 transition-all duration-300 backdrop-blur-sm hover:shadow-2xl hover:scale-105" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>
        <div class="modal-wood p-10 max-w-2xl text-center animate-fadeIn relative">
            <h2 class="text-6xl font-black mb-4 text-[#4CAF50]" style="text-shadow: 4px 4px 0 rgba(0,0,0,0.25);">¡FELICIDADES!</h2>
            <p class="text-3xl font-bold text-[#5A3516] mb-4">Has completado el puente de la lógica</p>
            <p class="text-2xl font-semibold text-[#5A3516] mb-6">Tiempo: <span id="victory-time" class="text-[#2E7D32] font-black">00:00</span></p>
            <button id="victory-restart" class="bg-[#4CAF50] hover:bg-[#45A049] text-white border-4 border-[#2E7D32] py-4 px-10 text-3xl font-black rounded-2xl cursor-pointer shadow-lg transition-all duration-300 hover:scale-105">Jugar de nuevo</button>
        </div>
    </div>
    <!-- Modal bloqueado -->
    <div id="locked-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-[500] px-4">
        <div class="bg-gradient-to-br from-[#FFEAA7] to-[#F9D68A] border-8 border-[#FED32C] rounded-3xl p-10 text-center max-w-xl shadow-2xl bg-cover bg-blend-overlay relative" style="background-image: url('{{ asset('imagenes/header-wood.png') }}'); animation: fadeIn 0.5s ease-out;">
            <h2 class="text-5xl font-black mb-4 text-[#E91E63]" style="text-shadow: 4px 4px 0 rgba(0,0,0,0.2);">Bloqueado</h2>
            <p class="text-2xl text-[#5A3516] font-bold my-4">Completa primero el juego de las sumas para desbloquear este puente.</p>
            <button id="locked-go" class="bg-[#4CAF50] hover:bg-[#45A049] text-white border-4 border-[#2E7D32] py-4 px-10 text-2xl font-black rounded-2xl cursor-pointer shadow-lg transition-all duration-300 hover:scale-105">Ir al juego de sumas</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Definir ruta absoluta de la piedra para JS
    window.STONE_IMAGE_PATHS = {
        1: "{{ asset('imagenes/roca.png') }}",
        2: "{{ asset('imagenes/roca.png') }}",
        3: "{{ asset('imagenes/roca.png') }}",
        4: "{{ asset('imagenes/roca.png') }}",
        5: "{{ asset('imagenes/roca.png') }}",
        6: "{{ asset('imagenes/roca.png') }}",
        7: "{{ asset('imagenes/roca.png') }}",
        8: "{{ asset('imagenes/roca.png') }}",
        9: "{{ asset('imagenes/roca.png') }}"
    };
    window.GREEN_STONE_IMAGE_PATH = "{{ asset('imagenes/rocaverde.png') }}";
    window.RED_STONE_IMAGE_PATH = "{{ asset('imagenes/rocaroja.png') }}";
    window.SUMAS_GAME_URL = "{{ route('juego-sumas') }}";
    window.SAVE_PARTIDA_URL = "{{ route('partida.save') }}";
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('menu-btn');
        const dropdown = document.getElementById('menu-dropdown');
        let dropdownOpen = false;
        menuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
            dropdownOpen = !dropdownOpen;
        });
        document.addEventListener('click', function(e) {
            if (dropdownOpen && !dropdown.contains(e.target) && e.target !== menuBtn) {
                dropdown.classList.add('hidden');
                dropdownOpen = false;
            }
        });
        document.getElementById('restart-btn').addEventListener('click', function() {
            if (typeof restartGame === 'function') restartGame(true);
            dropdown.classList.add('hidden');
            dropdownOpen = false;
        });
        document.getElementById('exit-btn').addEventListener('click', function() {
            window.location.href = "{{ route('home') }}";
        });
    });
</script>
<script src="{{ asset('js/puente-logica.js') }}"></script>
@endsection
