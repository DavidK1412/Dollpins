@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/auth/base.css')}}">
@endsection

@section('content')
    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo de Dollpins" class="logo">
            <h2>¡Bienvenida de nuevo!</h2>
            @if( session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if( session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form
                action="{{ Route('login') }}"
                method="POST"
                class="login-form"
            >

                @csrf
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input name="email" type="email" id="email" placeholder="Correo electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input name="password" type="password" id="password" placeholder="Contraseña" required>
                    <span id="show-password" class="show-password">👁️</span> <!-- Icono del ojo -->
                </div>
                <a href="{{ route('password.request')  }}" class="forgot-password">¿Olvidó su contraseña?</a>
                <button type="submit" class="login-btn">Iniciar sesión</button>
            </form>
        </div>
        <footer>
            <p>&copy;2024 Dollpins by Gabriela Moreno</p>
        </footer>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('js/auth/password_utils.js')}}"></script>
@endsection
