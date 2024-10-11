@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dashboard/base.css')}}">
    @yield('dashboard-styles')
@endsection


@section('content')
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <div class="sidebar" id="sidebar">
        <div>
            <div class="sidebar-header">
                <img alt="Company Logo" height="50" src="https://storage.googleapis.com/a1aa/image/MkUuT3m5z7KFPZ1qOQXoATdMOSF8NHkOBymgcbi1xSdBHb5E.jpg" width="50"/>
                <h2>
                    Dollpins
                </h2>
            </div>
            <hr/>
            <a href="#">
                Empleados
            </a>
            <a href="#">
                Productos
            </a>
            <a href="#">
                Clientes
            </a>
            <a href="#">
                Pedidos
            </a>
            <a href="#">
                Finanzas
            </a>
            <a href="#">
                Estadísticas
            </a>
        </div>
        <a href="#" style="margin-top: auto;">
            <i class="bi bi-arrow-bar-left"></i>
            {{ Auth::user()  }}
        </a>
    </div>
    <div class="content">

        @yield('dashboard-panel')
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
@endsection

@section('scripts')
    <script src="{{asset('js/dashboard/sidebar.js')}}"></script>
    @yield('dashboard-scripts')
@endsection
