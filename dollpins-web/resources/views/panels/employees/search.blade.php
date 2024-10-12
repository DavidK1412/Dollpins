@extends('dashboard')

@section('dashboard-panel')
    <h1>
        Hola {{ getEmployeeName() }},
    </h1>
    <h2>
        Gestión de empleados
    </h2>
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
            @if($employee->status != 2)
                <tr>
                    <td>{{ $employee->document }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <a href="{{Route('employee.show', ['id' => $employee->id])}}" class="btn btn-info"><i class="bi bi-eye"></i> Ver</a>

                        <a href="{{Route('employee.edit', ['id' => $employee->id])}}" class="btn btn-primary"><i class="bi bi-pencil"></i> Editar</a>
                        <a href="{{Route('employee.delete', ['id' => $employee->id])}}" class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-check-lg" style=" color: #198754; font-size: 1.5rem;"></i>
                    <strong class="me-auto">Acción de empleado ejecutada correctamente!</strong>
                    <small>Hace 1 segundo</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Verifica los detalles del empleado en la tabla.
                </div>
            </div>
        </div>
    @endif

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

    @if(session('success'))
        <script>
            const toastLiveExample = document.getElementById('liveToast')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show()
        </script>
    @endif
@endsection
