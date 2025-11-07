<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | Control de Finanzas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <img src="{{ asset('images/finanzas3.png') }}" alt="Logo" class="logo">
            <h4 class="text-brand">Control de Finanzas</h4>
            <p class="text-muted">Bienvenido, por favor inicia sesión</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('mensaje'))
            <div class="alert alert-success text-center">
                {{ session('mensaje') }}
            </div>
        @endif

        <form action="{{ route('login.autenticar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-finanzas w-100 mt-3">Iniciar Sesión</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">© {{ date('Y') }} Control de Finanzas - Todos los derechos reservados</small>
        </div>
    </div>
</body>
</html>