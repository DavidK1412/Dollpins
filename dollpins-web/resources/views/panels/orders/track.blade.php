<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Orden</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon page -->
    <link rel="icon" href="{{asset('assets/logo.png')}}">
    <style>
        body {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .tracking-container {
            background-color: #fff;
            color: #333;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .tracking-container img {
            max-width: 80px;
            margin-bottom: 15px;
        }
        .order-steps {
            margin: 20px 0;
        }
        .step {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .step.completed {
            background-color: #28a745;
            color: #fff;
        }
        .step.current {
            background-color: #ffc107;
            color: #fff;
        }
        .step.pending {
            background-color: #f0f0f0;
            color: #333;
        }
        .buttons .btn {
            width: 48%;
        }
    </style>
</head>
<body>
<div class="tracking-container">
    <img src="{{asset('assets/logo.png')}}" alt="Logo de la tienda">
    <h1>Seguimiento de tu orden</h1>
    <p>Enviado a <strong>{{$order->delivery_address}}</strong></p>
    <p>Estado actual: <strong>{{$order->status->name}}</strong></p>

    <div class="order-steps">
        <div class="step @if($order->status_id == 1) current @elseif($order->status_id > 1) completed @endif">Orden recibida</div>
        <div class="step @if($order->status_id == 2) current @elseif($order->status_id > 2) completed @endif">En camino</div>
        <div class="step @if($order->status_id == 3) completed @endif">Entregado</div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
