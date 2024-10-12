<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <style>
        body {
            background-color: #333;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-card {
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .error-card img {
            width: 100px;
            height: auto;
        }
        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 1rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .btn-custom {
            margin-top: 20px;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }
        .btn-custom-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom-primary:hover {
            background-color: white;
            color: #007bff;
            border: 2px solid #007bff;
        }
        .btn-custom-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-custom-danger:hover {
            background-color: white;
            color: #dc3545;
            border: 2px solid #dc3545;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
    <div class="card error-card">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        <h2>¿Para dónde?</h2>
        <p>La página que buscas no existe. (o quizás no tienes acceso)</p>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a href="{{ route('dashboard') }}" class="btn btn-custom btn-custom-primary">Volver al inicio</a>
            <a href="{{ route('logout') }}" class="btn btn-custom btn-custom-danger">Cerrar sesión</a>
        </div>
    </div>
</div>
</body>
</html>
