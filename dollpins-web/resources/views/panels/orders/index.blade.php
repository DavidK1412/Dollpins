@extends('dashboard')

@section('dashboard-panel')
    <nav class="nav nav-pills nav-justified">

        @if($filter === 'Pendiente')
            <a class="nav-link active" aria-current="page" href="{{Route('orders.index', ['filter' => 'Pendiente'])}}">Pendientes</a>
        @else
            <a class="nav-link" aria-current="page" href="{{Route('orders.index', ['filter' => 'Pendiente'])}}">Pendientes</a>
        @endif

        @if($filter === 'Enviado')
                <a class="nav-link active" aria-current="page" href="{{Route('orders.index', ['filter' => 'Enviado'])}}">Enviados</a>
            @else
                <a class="nav-link" aria-current="page" href="{{Route('orders.index', ['filter' => 'Enviado'])}}">Enviados</a>
            @endif
            @if($filter === 'Finalizado')
                <a class="nav-link active" aria-current="page" href="{{Route('orders.index', ['filter' => 'Finalizado'])}}">Finalizados</a>
            @else
                <a class="nav-link" aria-current="page" href="{{Route('orders.index', ['filter' => 'Finalizado'])}}">Finalizados</a>
            @endif
    </nav>
    <a type="button" class="btn btn-success mt-3" href="{{ Route('orders.new') }}">
        <i class="bi bi-bookmark-plus"></i> Crear orden
    </a>
    <!-- If redirect with success, show this alert -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table id="example" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Dirección de envio</th>
            <th>Total</th>
            <th>Empleado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->client->name }}</td>
                <td>{{ $order->delivery_address }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->employee->name }}</td>
                <td>
                    <a href="{{Route('orders.show', ['id' => $order->id])}}" class="btn btn-info">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                    <!-- Button for upgrade order -->
                    @if($filter !== 'Finalizado')
                        <a href="{{Route('orders.upgrade', ['order' => $order->id])}}" class="btn btn-success">
                            <i class="bi bi-arrow-up-circle"></i>
                        </a>
                    @endif



                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('dashboard-scripts')
    <script>
        new DataTable('#example',{
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            }
        );
    </script>
@endsection
