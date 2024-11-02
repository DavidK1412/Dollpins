@extends('dashboard')

@section('dashboard-panel')
    <h1>
        Hola {{ getEmployeeName() }},
    </h1>
    <h2>
        Gestión de Productos
    </h2>
    <a href="{{ Route('products.new')  }}" class="btn btn-success" style="background-color: #8fd6c8 !important;"><i class="bi bi-bookmark-plus"></i> Crear producto</a>
    <table id="example" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Categoría</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            @if($product->status != 2)
                <tr>
                    <td>
                        {{ $product->category->name }}
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                        @if(hasRole(['ADMIN', 'STOCK']))
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        @endif
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
                    <strong class="me-auto">Acción de producto ejecutada correctamente!</strong>
                    <small>Hace 1 segundo</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Verifica los detalles del producto en la tabla.
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deletePhoneForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deletePhoneId" name="id">
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar el producto <span id="deletePhoneNumber"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
        function confirmDelete(id, phone) {
            document.getElementById('deletePhoneId').value = id;
            document.getElementById('deletePhoneNumber').textContent = phone;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>

    @if(session('success'))
        <script>
            const toastLiveExample = document.getElementById('liveToast')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show()
        </script>
    @endif

@endsection
