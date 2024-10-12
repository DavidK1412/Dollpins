@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/auth/recovery.css')}}">
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-dark">
        <div class="card p-4 text-center login-card">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="mb-3" id="logo">
            <h2 class="mb-3">Recupera tu contraseña</h2>
            <p>Ingresa tu correo electrónico y te enviaremos un enlace para que recuperes el acceso a tu cuenta.</p>
            <form
                action="{{ route('password.generate') }}"
                method="POST"
                class="mt-3"
            >
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Correo electrónico">
                </div>
                @csrf
                <button type="submit" class="btn btn-custom w-100">Enviar</button>
            </form>
            <br>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <a href="{{ route('login') }}" class="mt-3">Regresar al inicio de sesión</a>
        </div>
    </div>
    <footer class="text-center text-light mt-4">
        <p>©2024 Dollpins by Gabriela Moreno</p>
    </footer>
@endsection
