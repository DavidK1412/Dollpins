@extends('dashboard')

@section('dashboard-panel')
    <h1>
        Hola Administrador,
    </h1>
    <h2>
        Gestión de empleados
    </h2>
    <!-- Boton par acrear un nuevo empleado -->
    <a href="{{ Route('employee.new')  }}" class="btn btn-success" style="background-color: #8fd6c8 !important;"><i class="bi bi-bookmark-plus"></i> Crear empleado</a>
    <table id="example" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->document }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>
                    <a href="#" class="btn btn-info"><i class="bi bi-eye"></i> Ver</a>
                    <a href="#" class="btn btn-primary"><i class="bi bi-pencil"></i> Editar</a>
                    <a href="#" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
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
