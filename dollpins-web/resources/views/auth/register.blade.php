@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/auth/base.css')}}">
@endsection

@section('content')
    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo de Dollpins" class="logo">
            <h2>¡Bienvenida de nuevo!</h2>
            <form>
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" placeholder="Correo electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" placeholder="Contraseña" required>
                    <span id="show-password" class="show-password">👁️</span>
                </div>
                <a href="{{ route('forgot')  }}" class="forgot-password">¿Olvidó su contraseña?</a>
                <button type="submit" class="login-btn">Iniciar sesión</button>
                <button type="button" class="register-btn">Registrarme</button>
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
