@extends('dashboard')
@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('dashboard-panel')
    <div class="card text-center">
        <div class="card-header">
            <h1>Agregar Producto a la Orden</h1>
        </div>

        <div class="card-body">
        <!-- Selección del Producto y Cantidad -->
            <form id="addProductForm" action="" method="POST">
                @csrf <!-- Token CSRF de seguridad -->
                <div class="mb-3">
                    <label for="product" class="form-label">Producto</label>
                    <select name="product_id" id="product" class="form-select"  required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-stock="{{ $product->stock }}" data-price="{{ $product->price }}">
                                {{ $product->name }} - ${{ $product->price }} - Stock: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                </div>

                <button type="button" class="btn btn-primary" id="addProductButton">Agregar a la Orden</button>
                <a href="{{ route('orders.create.last', $order->id) }}" class="btn btn-success">Siguente paso</a>
            </form>

        <!-- Subtotal -->
        <div id="subtotal" class="mt-3">
            <strong>Subtotal: </strong> $<span id="subtotalValue">{{$order->sub_total}}</span>
        </div>

        <!-- Popup de Confirmación -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirmar Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de agregar este producto a la orden?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="confirmAddProductButton">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Tabla con productos actuales en la orden -->
        <div class="card-footer">
            <h2>Productos en la Orden</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>${{ $product->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td>${{ $order->sub_total }}</td>
                    </tr>
                </tbody>
            </table>
    </div>
@endsection

@section('dashboard-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( '#product').select2( {
            theme: "bootstrap-5",
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
    <script>
        let selectedProduct = null;
        let selectedQuantity = null;
        let orderId = '{{ $order->id }}';
        let flag = false;

        // Mostrar el subtotal cuando se seleccione un producto y cantidad
        document.getElementById('product').addEventListener('change', updateSubtotal);
        document.getElementById('quantity').addEventListener('input', updateSubtotal);

        function updateSubtotal() {
            selectedProduct = document.getElementById('product').selectedOptions[0];
            selectedQuantity = document.getElementById('quantity').value;

            let stock = selectedProduct.getAttribute('data-stock');
            let price = selectedProduct.getAttribute('data-price');
            console.log(typeof selectedQuantity,typeof stock);
            if (selectedQuantity === null || selectedQuantity === '' || selectedQuantity < 1 || (parseInt(selectedQuantity) > parseInt(stock))) {
                document.getElementById('addProductButton').disabled = true;
                flag = false;
                return;
            }
            flag = true;
            document.getElementById('subtotalValue').innerText = price * selectedQuantity;
            document.getElementById('addProductButton').disabled = false;
        }

        // Mostrar el modal de confirmación
        document.getElementById('addProductButton').addEventListener('click', function() {
            if (!flag) {
                alert('Stock insuficiente');
                return;
            }

            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        });

        // Confirmar la adición del producto
        document.getElementById('addProductButton').addEventListener('click', function() {
            let stock = selectedProduct.getAttribute('data-stock');
            let quantity = selectedQuantity;

            if (!flag) {
                alert('Stock insuficiente');
                return;
            }

            // Mostrar el modal de confirmación
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        });

        // Confirmar la adición del producto cuando se haga clic en "Confirmar"
        document.getElementById('confirmAddProductButton').addEventListener('click', function() {
            // Cuando el usuario confirma, enviar el formulario
            document.getElementById('addProductForm').submit();
        });
    </script>
@endsection

