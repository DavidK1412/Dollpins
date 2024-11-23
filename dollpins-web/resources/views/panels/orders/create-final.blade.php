@extends('dashboard')
@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('dashboard-panel')
    <div class="alert alert-danger">
        <b>Importante</b>, una vez creada la orden, no se podrá modificar.
        |  Así mismo, si esta no se finaliza no se guardará ni se podrán reasignar productos.
        <b>Importante, confirmar dos veces antes de confirmar cualquier acción.</b>
    </div>
    <div class="card text-center">
        <div class="card-header">
            <h1>Confirmar Orden</h1>
        </div>

        <div class="card-body">
            <h5 class="card-title">Confirma los productos y la orden</h5>
            <p class="card-text">Revisa los productos y la orden antes de confirmar.</p>
            <div class="row">
                <div class="col-6">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
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
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="client" class="form-label">Cliente</label>
                        <input type="text" name="client" id="client" class="form-control" value="{{ $order->client->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Sub Total</label>
                        <input type="text" name="total" id="total" class="form-control" value="${{ $order->sub_total }}" readonly>
                    </div>
                    <form action="" method="POST">
                        @csrf <!-- Token CSRF de seguridad -->
                        <!--  delivery_address, extras, discount inputs and labels -->
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">Dirección de entrega</label>
                            <input type="text" name="delivery_address" id="delivery_address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="extras" class="form-label">Extras</label>
                            <input type="number" name="extras" id="extras" class="form-control" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Descuento</label>
                            <input type="number" name="discount" id="discount" class="form-control" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="bi bi-check2"></i>
                            Confirmar Orden
                        </button>
                    </form>
                </div>
            </div>




        </div>
    </div>


@endsection
