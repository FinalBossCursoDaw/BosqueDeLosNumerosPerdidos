@extends(Auth::check() ? 'landing-auth-header' : 'landing-header')

@section('title', 'Valle de las Frutas Encantadas')

@section('body-class', 'm-0 p-0 overflow-hidden bg-cover bg-center h-screen pt-32')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/valleDeLasFrutasEncantadas.css') }}">
@endsection

@section('content')
    <h1>🍎 Valle de las Frutas Encantadas 🍓</h1>
    <script src="{{ asset('js/valleDeLasFrutasEncantadas.js') }}"></script>
@endsection
