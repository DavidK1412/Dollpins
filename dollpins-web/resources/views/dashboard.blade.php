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
                <img alt="Company Logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>
                <h2>
                    Dollpins
                </h2>
            </div>
            <hr/>
            @if(hasRole('ADMIN'))
                <a href="{{ Route('employees.show') }}">
                    Empleados
                </a>
            @endif
            @if(hasRole(['ADMIN', 'STOCK', 'SALES']))
            <a href="{{ Route('products.index') }}">
                Productos
            </a>
            @endif
            @if(hasRole(['ADMIN', 'SALES']))
            <a href="
                {{ Route('clients.index') }}
            ">
                Clientes
            </a>

            <a href="#">
                Pedidos
            </a>
            @endif
            @if(hasRole(['ADMIN', 'FINANCES']))
            <a href="#">
                Finanzas
            </a>
            <a href="#">
                Estadísticas
            </a>
            @endif
        </div>
        <a href="{{Route('logout')}}" style="margin-top: auto;">
            <i class="bi bi-arrow-bar-left"></i>
            {{ getEmployeeName() }}
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
