<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            color: #333;
            font-size: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }
        .order-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
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
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f1f1f1;
            color: #777;
            font-size: 14px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header">
        <h1>¡Gracias por tu compra!</h1>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h2>Hola {{ $order->client->name }},</h2>
        <p>¡Gracias por comprar con nosotros! Tu pedido ha sido procesado correctamente. Aquí tienes los detalles de tu compra:</p>

        <!-- Order Details Section -->
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

        <p>Para hacer seguimiento de tu pedido, puedes dar click aquí:
            <a href="{{ route('orders.track', $order->id) }}">Ver Pedido</a>
        </p>

        <p>Tu pedido será enviado a la siguiente dirección:</p>
        <p><strong>Dirección de envío:</strong> {{ $order->delivery_address }}</p>

        <p>Si tienes alguna pregunta, no dudes en contactarnos. Estaremos encantados de ayudarte.</p>

        <p>Gracias por elegirnos, ¡esperamos verte pronto nuevamente!</p>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; {{ Date('Y') }} Dollpins | Todos los derechos reservados.</p>
        <p><a href="">Visítanos en línea</a></p>
    </div>
</div>

</body>
</html>
