@extends('dashboard')
@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <style>
        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .order-details table th,
        .order-details table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .order-details table th {
            background-color: #f1f1f1;
            text-align: left;
        }
    </style>
@endsection

@section('dashboard-panel')
    <div class="card text-center">
        <div class="card-header">
            <a href="{{Route('orders.index', ['filter' => 'Pendiente'])}}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <h1>Orden #{{ $order->id }}</h1>
        </div>

        <div class="card-body">

            <h5 class="card-title">
                Detalles de la orden</h5>
            <p class="card-text">Revisa los detalles de la orden.</p>
            <div class="order-details">
                <h3>Detalles del Pedido</h3>
                <table>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                    <!-- Ejemplo de productos. Esto se generará dinámicamente -->
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>${{ $product->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Sub Total</th>
                        <td>${{ $order->sub_total }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Extras</th>
                        <td>${{ $order->extras }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Descuento</th>
                        <td>${{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Total</th>
                        <td>${{ $order->total }}</td>
                    </tr>
                </table>
            </div>
            <div class="mb-3">
                <label for="client" class="form-label">Cliente</label>
                <input type="text" name="client" id="client" class="form-control" value="{{ $order->client->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="delivery_address" class="form-label">Dirección de entrega</label>
                <input type="text" name="delivery_address" id="delivery_address" class="form-control" value="{{ $order->delivery_address }}" readonly>
            </div>
            <div class="mb-3">
                <label for="employee" class="form-label">Empleado</label>
                <input type="text" name="employee" id="employee" class="form-control" value="{{ $order->employee->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $order->status->name }}" readonly>
            </div>

    </div>
@endsection
