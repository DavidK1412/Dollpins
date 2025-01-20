@extends('dashboard')

@section('dashboard-styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
@endsection

@section('dashboard-panel')
    <h1>
        Hola {{ getEmployeeName() }},
    </h1>
    <h2>
        Estadisticas
    </h2>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @php
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    @endphp

    <br>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('stats.report') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="reportType" class="block text-gray-700 font-bold mb-2">Tipo de Reporte:</label>
                <select id="reportType" name="reportType"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        onchange="toggleFields()">
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="Pedidos">Pedidos</option>
                    <option value="Ventas">Ventas</option>
                </select>
            </div>

            <div id="sharedFields" class="space-y-4">
                <div>
                    <label for="startDate" class="block text-gray-700 font-bold mb-2">Fecha de Inicio:</label>
                    <input type="date" id="startDate" name="startDate"
                           max="{{ date('Y-m-d') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="endDate" class="block text-gray-700 font-bold mb-2">Fecha de Fin:</label>
                    <input type="date" id="endDate" name="endDate"
                           max="{{ date('Y-m-d') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none">
                    Generar Reporte
                </button>
            </div>
        </form>
    </div>
@endsection

@section('dashboard-scripts')
    <script>
        function toggleFields() {
            const reportType = document.getElementById('reportType').value;
            const sharedFields = document.getElementById('sharedFields');

            // Mostrar siempre los campos de fechas
            if (reportType === 'Pedidos' || reportType === 'Ventas') {
                sharedFields.style.display = 'block';
            } else {
                sharedFields.style.display = 'none';
            }
        }
    </script>
@endsection
