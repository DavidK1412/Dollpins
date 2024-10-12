@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/auth/recovery.css')}}">
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-dark">
        <div class="card p-4 text-center login-card">
            <center>
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="img-fluid mb-4" style="max-width: 100px;">
            </center>
            <h2 class="mb-4">Restablecer contraseña</h2>
            <form id="reset-password-form" action="{{route('password.change')}}" method="POST">
                @csrf
                <input type="hidden"  name="token" value="{{ $token }}">

                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme su contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg w-100 mb-3" style="background-color: #9EE5D1;">Restablecer</button>
                <div id="error">
                </div>
            </form>
            <a href="{{ route('login') }}" class="mt-3">Regresar al inicio de sesión</a>
        </div>
    </div>
    <footer class="text-center text-light mt-4">
        <p>©2024 Dollpins by Gabriela Moreno</p>
    </footer>
@endsection

@section('scripts')
    <script>
        const form = document.getElementById('reset-password-form');
        const error = document.getElementById('error');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const password = form.querySelector('input[type="password"]').value;
            const confirmPassword = form.querySelectorAll('input[type="password"]')[1].value;

            if (password !== confirmPassword) {
                error.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Las contraseñas no coinciden.
                    </div>
                `;
                return;
            }

            form.submit();
        });

    </script>
@endsection
