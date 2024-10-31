@extends('dashboard')

@section('dashboard-panel')
    <div class="container-fluid">
        <h1>
            Directorio telefónico
        </h1>
        <h2>
            Gestión de contactos
        </h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/logo.png') }}" alt="Dollpins Logo" class="img-fluid" style="height: 64px;">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="phonesTable">
                        <thead>
                            <tr>
                                <th>Teléfono</th>
                                <th>Parentesco</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cellphones as $cellphone)
                                <tr>
                                    <td>{{ $cellphone->cellphone }}</td>
                                    <td>{{ $cellphone->relationship }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" onclick="editPhone('{{ $cellphone->id }}', '{{ $cellphone->cellphone }}', '{{ $cellphone->relationship }}')">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $cellphone->id }}', '{{ $cellphone->cellphone }}')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('employees.show') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <button class="btn btn-success" style="background-color: #8fd6c8 !important;" onclick="showAddModal()">
                        <i class="bi bi-plus-lg"></i> Agregar Teléfono
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nuevo teléfono</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addPhoneForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Número de teléfono</label>
                            <input type="text" class="form-control" id="phone" name="cellphone" required>
                        </div>
                        <div class="mb-3">
                            <label for="relationship" class="form-label">Parentesco</label>
                            <input type="text" class="form-control" id="relationship" name="relationship" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" style="background-color: #8fd6c8 !important;">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar teléfono</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPhoneForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPhoneId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Número de teléfono</label>
                            <input type="text" class="form-control" id="editPhone" name="cellphone" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRelationship" class="form-label">Parentesco</label>
                            <input type="text" class="form-control" id="editRelationship" name="relationship" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Teléfono</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deletePhoneForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deletePhoneId" name="id">
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar el teléfono <span id="deletePhoneNumber"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-check-lg" style=" color: #198754; font-size: 1.5rem;"></i>
                    <strong class="me-auto">Acción de telefono ejecutada correctamente!</strong>
                    <small>Hace 1 segundo</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Verifica los detalles de los telefonos en la tabla.
                </div>
            </div>
        </div>
    @endif
@endsection

@section('dashboard-scripts')
    <script>
        // Inicializar DataTable
        new DataTable('#phonesTable', {
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
        });

        
        function showAddModal() {
            const modal = new bootstrap.Modal(document.getElementById('addModal'));
            modal.show();
        }

        function editPhone(id, phone, relationship) {
            document.getElementById('editPhoneId').value = id;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editRelationship').value = relationship;
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }

        function confirmDelete(id, phone) {
            document.getElementById('deletePhoneId').value = id;
            document.getElementById('deletePhoneNumber').textContent = phone;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }


        @if(session('success'))
            const toastLiveExample = document.getElementById('liveToast')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show()
        @endif
    </script>
@endsection