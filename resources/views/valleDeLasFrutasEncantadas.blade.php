@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('title', 'Valle de las Frutas Encantadas')

@section('body-class', 'm-0 p-0 overflow-hidden bg-cover bg-center h-screen pt-32')

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/valleDeLasFrutasEncantadas.css') }}">
@endsection

@section('content')
    <h1>🍎 Valle de las Frutas Encantadas 🍓</h1>
    @section('scripts')
        <script>
            window.VALLEFRUTASENCANTADAS_GAME_URL = "{{ route('valle-frutas') }}";
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
    @endsection
    <script src="{{ asset('resources/js/valleDeLasFrutasEncantadas.js') }}"></script>
@endsection
