@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/auth/base.css')}}">
@endsection

@section('content')
    <div class="login-container">
        <div class="login-box">
            <img src="https://media.canva.com/v2/image-resize/format:PNG/height:198/quality:100/uri:s3%3A%2F%2Fmedia-private.canva.com%2FAoVmU%2FMAGR0MAoVmU%2F1%2Fp.png/watermark:F/width:200?csig=AAAAAAAAAAAAAAAAAAAAAD0WG9pbViiOxE4llKrZV_R051IUMs7S5HmtNaXrwAxS&exp=1728584289&osig=AAAAAAAAAAAAAAAAAAAAAImbBVKy3JKThlTGkE12iiPQHXbDWITQYVCpikNZfWp1&signer=media-rpc&x-canva-quality=thumbnail" alt="Logo de Dollpins" class="logo">
            <h2>¡Bienvenida de nuevo!</h2>
            @if( session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form>

                @csrf
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" placeholder="Correo electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" placeholder="Contraseña" required>
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
