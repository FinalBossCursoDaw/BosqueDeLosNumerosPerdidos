@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('title', 'Clasificación - Juego de las Sumas')

@section('body-class', 'm-0 p-0 bg-cover bg-center min-h-screen pt-32')

@section('styles')
<style>
    body {
        background-image: url('{{ asset('imagenes/fondolanding.png') }}');
        background-attachment: fixed;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out;
    }
    
    .animate-slideIn {
        animation: slideIn 0.5s ease-out;
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .card-wood {
        background: linear-gradient(135deg, #FFEAA7 0%, #F9D68A 50%, #E8C574 100%);
        border: 6px solid #FED32C;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3), inset 0 0 0 4px rgba(134, 98, 47, 0.2);
        background-image: url('{{ asset('imagenes/header-wood.png') }}');
        background-size: cover;
        background-blend-mode: overlay;
    }
    
    .medal-gold {
        background: linear-gradient(135deg, #FFD700, #FFA500);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.5);
    }
    
    .medal-silver {
        background: linear-gradient(135deg, #C0C0C0, #A8A8A8);
        box-shadow: 0 4px 15px rgba(192, 192, 192, 0.5);
    }
    
    .medal-bronze {
        background: linear-gradient(135deg, #CD7F32, #B87333);
        box-shadow: 0 4px 15px rgba(205, 127, 50, 0.5);
    }
    
    .shimmer {
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        background-size: 1000px 100%;
        animation: shimmer 3s infinite;
    }
    
    .stat-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
    
    .ranking-row:hover {
        background: rgba(254, 211, 44, 0.2);
        transform: scale(1.02);
    }
    
    .game-tab {
        transition: all 0.3s ease;
        background: #D4A574;
        color: #5A3516;
        border-color: #8B7355;
    }
    
    .game-tab.active {
        background: linear-gradient(135deg, #4CAF50, #45A049);
        color: white;
        border-color: #2E7D32;
        transform: scale(1.05);
    }
</style>
@endsection

@section('content')
<div class="min-h-screen py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Título principal -->
        <div class="text-center mb-8 animate-fadeIn">
            <div class="flex items-center justify-center gap-6 mb-4">
                <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Sumina" class="w-32 h-32 animate-bounce-slow drop-shadow-2xl">
                <h1 class="text-6xl font-black text-[#FED32C]" style="text-shadow: 4px 4px 0 #86622F; -webkit-text-stroke: 4px #86622F; paint-order: stroke fill;">
                    CLASIFICACIÓN
                </h1>
                <img src="{{ asset('imagenes/abeja-sunima-derecha.png') }}" alt="Sumina" class="w-32 h-32 animate-bounce-slow drop-shadow-2xl" style="animation-delay: 0.5s;">
            </div>
            
            <!-- Selector de juego -->
            <div class="flex justify-center gap-4 mb-4">
                <button onclick="showGame('sumas')" id="btn-sumas" class="game-tab px-8 py-3 rounded-xl font-black text-xl border-4 shadow-lg">
                    🌻 Bosque de las Sumas
                </button>
                <button onclick="showGame('puente')" id="btn-puente" class="game-tab px-8 py-3 rounded-xl font-black text-xl border-4 shadow-lg">
                    🌉 Puente de la Lógica
                </button>
            </div>
            
            <p id="subtitle-sumas" class="game-subtitle text-2xl font-bold text-[#FFEAA7]" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                Los mejores jugadores del Bosque de las Sumas
            </p>
            <p id="subtitle-puente" class="game-subtitle hidden text-2xl font-bold text-[#FFEAA7]" style="text-shadow: 3px 3px 6px rgba(0,0,0,0.8);">
                Los mejores jugadores del Puente de la Lógica
            </p>
        </div>

        <!-- Estadísticas generales - SUMAS -->
        <div id="stats-sumas" class="game-content grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total de partidas -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Total Partidas</p>
                        <p class="text-4xl font-black text-[#2E7D32]">{{ $totalPartidasSumas }}</p>
                    </div>
                    <div class="bg-[#4CAF50] p-4 rounded-full border-4 border-[#2E7D32]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Partidas completadas -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Completadas</p>
                        <p class="text-4xl font-black text-[#4CAF50]">{{ $partidasCompletadasSumas }}</p>
                    </div>
                    <div class="bg-[#FFD700] p-4 rounded-full border-4 border-[#FFA500]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Promedio de puntuación -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Puntuación Media</p>
                        <p class="text-4xl font-black text-[#FED32C]">{{ number_format($promedioPuntuacionSumas, 0) }}</p>
                    </div>
                    <div class="bg-[#FED32C] p-4 rounded-full border-4 border-[#FFA500]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Estadísticas generales - PUENTE -->
        <div id="stats-puente" class="game-content hidden grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total de partidas -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Total Partidas</p>
                        <p class="text-4xl font-black text-[#2E7D32]">{{ $totalPartidasPuente }}</p>
                    </div>
                    <div class="bg-[#4CAF50] p-4 rounded-full border-4 border-[#2E7D32]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Partidas completadas -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Completadas</p>
                        <p class="text-4xl font-black text-[#4CAF50]">{{ $partidasCompletadasPuente }}</p>
                    </div>
                    <div class="bg-[#FFD700] p-4 rounded-full border-4 border-[#FFA500]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Promedio de tiempo -->
            <div class="card-wood p-6 stat-card transition-all duration-300 animate-slideIn" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-bold text-[#5A3516] mb-1">Tiempo Medio</p>
                        <p class="text-4xl font-black text-[#FED32C]">{{ gmdate('i:s', $promedioTiempoPuente) }}</p>
                    </div>
                    <div class="bg-[#FED32C] p-4 rounded-full border-4 border-[#FFA500]">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 Jugadores - SUMAS -->
        <div id="tabla-sumas" class="game-content card-wood p-8 animate-fadeIn">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-[#FFD700] p-3 rounded-full border-4 border-[#FFA500]">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-[#5A3516]" style="text-shadow: 2px 2px 0 #FED32C;">
                    TOP 10 MEJORES JUGADORES
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-4 border-[#D4A574]">
                            <th class="px-4 py-4 text-left text-xl font-black text-[#5A3516]">Posición</th>
                            <th class="px-4 py-4 text-left text-xl font-black text-[#5A3516]">Jugador</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Puntuación</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Tiempo</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Vidas</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topJugadoresSumas as $index => $partida)
                        <tr class="ranking-row border-b-2 border-[#E8C574] transition-all duration-300 hover:bg-[#FED32C]/20" style="animation: slideIn {{ ($index + 1) * 0.1 }}s ease-out;">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    @if($index === 0)
                                        <div class="medal-gold w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#FFA500]">
                                            1
                                        </div>
                                    @elseif($index === 1)
                                        <div class="medal-silver w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#888]">
                                            2
                                        </div>
                                    @elseif($index === 2)
                                        <div class="medal-bronze w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#9D6B3B]">
                                            3
                                        </div>
                                    @else
                                        <div class="bg-[#8B7355] w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#5A3516]">
                                            {{ $index + 1 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-[#4CAF50] p-2 rounded-full border-2 border-[#2E7D32]">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xl font-bold text-[#5A3516]">{{ $partida->usuario->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-block bg-[#4CAF50] text-white px-4 py-2 rounded-full font-black text-lg border-4 border-[#2E7D32]">
                                    {{ number_format($partida->puntuacion, 0) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="text-lg font-bold text-[#5A3516]">
                                    {{ gmdate('i:s', $partida->tiempo_seg) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-1">
                                    @php
                                        $errores = $partida->sesion->errors ?? 0;
                                        $vidasRestantes = 3 - $errores;
                                    @endphp
                                    @for($i = 0; $i < 3; $i++)
                                        @if($i < $vidasRestantes)
                                            <span class="text-2xl">❤️</span>
                                        @else
                                            <span class="text-2xl opacity-30">🖤</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center text-sm font-bold text-[#5A3516]">
                                {{ \Carbon\Carbon::parse($partida->fecha)->format('d/m/Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Sin datos" class="w-24 h-24 opacity-50">
                                    <p class="text-2xl font-bold text-[#5A3516]">No hay partidas registradas aún</p>
                                    <p class="text-lg text-[#8B7355]">¡Sé el primero en aparecer en la clasificación!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Top 10 Jugadores - PUENTE -->
        <div id="tabla-puente" class="game-content hidden card-wood p-8 animate-fadeIn">
            <div class="flex items-center gap-4 mb-6">
                <div class="bg-[#FFD700] p-3 rounded-full border-4 border-[#FFA500]">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-[#5A3516]" style="text-shadow: 2px 2px 0 #FED32C;">
                    TOP 10 MEJORES JUGADORES
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-4 border-[#D4A574]">
                            <th class="px-4 py-4 text-left text-xl font-black text-[#5A3516]">Posición</th>
                            <th class="px-4 py-4 text-left text-xl font-black text-[#5A3516]">Jugador</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Tiempo</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Errores</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Movimientos</th>
                            <th class="px-4 py-4 text-center text-xl font-black text-[#5A3516]">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topJugadoresPuente as $index => $partida)
                        <tr class="ranking-row border-b-2 border-[#E8C574] transition-all duration-300 hover:bg-[#FED32C]/20" style="animation: slideIn {{ ($index + 1) * 0.1 }}s ease-out;">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    @if($index === 0)
                                        <div class="medal-gold w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#FFA500]">
                                            1
                                        </div>
                                    @elseif($index === 1)
                                        <div class="medal-silver w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#888]">
                                            2
                                        </div>
                                    @elseif($index === 2)
                                        <div class="medal-bronze w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#9D6B3B]">
                                            3
                                        </div>
                                    @else
                                        <div class="bg-[#8B7355] w-12 h-12 rounded-full flex items-center justify-center font-black text-white text-xl border-4 border-[#5A3516]">
                                            {{ $index + 1 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-[#4CAF50] p-2 rounded-full border-2 border-[#2E7D32]">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xl font-bold text-[#5A3516]">{{ $partida->usuario->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-block bg-[#4CAF50] text-white px-4 py-2 rounded-full font-black text-lg border-4 border-[#2E7D32]">
                                    {{ gmdate('i:s', $partida->tiempo_seg) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-block bg-[#D32F2F] text-white px-4 py-2 rounded-full font-black text-lg border-4 border-[#B71C1C]">
                                    {{ $partida->sesion->errors ?? 0 }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-block bg-[#FED32C] text-white px-4 py-2 rounded-full font-black text-lg border-4 border-[#FFA500]">
                                    {{ $partida->sesion->helps_clicks }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center text-sm font-bold text-[#5A3516]">
                                {{ \Carbon\Carbon::parse($partida->fecha)->format('d/m/Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <img src="{{ asset('imagenes/abejasunima.png') }}" alt="Sin datos" class="w-24 h-24 opacity-50">
                                    <p class="text-2xl font-bold text-[#5A3516]">No hay partidas registradas aún</p>
                                    <p class="text-lg text-[#8B7355]">¡Sé el primero en aparecer en la clasificación!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="text-center mt-8 animate-fadeIn">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-[#4CAF50] hover:bg-[#45A049] text-white font-black text-2xl py-4 px-10 rounded-2xl border-6 border-[#2E7D32] shadow-lg transition-all duration-300 hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Inicio
            </a>
        </div>
    </div>
</div>

<script>
    function showGame(game) {
        // Ocultar todos los contenidos de juegos
        const gameContents = document.querySelectorAll('.game-content');
        gameContents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remover clase active de todos los botones
        const tabs = document.querySelectorAll('.game-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Mostrar contenido del juego seleccionado
        if (game === 'sumas') {
            document.getElementById('subtitle-sumas').classList.remove('hidden');
            document.getElementById('subtitle-puente').classList.add('hidden');
            document.getElementById('stats-sumas').classList.remove('hidden');
            document.getElementById('tabla-sumas').classList.remove('hidden');
            document.getElementById('btn-sumas').classList.add('active');
        } else if (game === 'puente') {
            document.getElementById('subtitle-sumas').classList.add('hidden');
            document.getElementById('subtitle-puente').classList.remove('hidden');
            document.getElementById('stats-puente').classList.remove('hidden');
            document.getElementById('tabla-puente').classList.remove('hidden');
            document.getElementById('btn-puente').classList.add('active');
        }
    }
    
    // Inicializar con sumas visible por defecto
    document.addEventListener('DOMContentLoaded', function() {
        showGame('sumas');
    });
</script>
@endsection
