<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio</title>
</head>
<body>
    <h2>Bienvenido, {{ $usuario->nombre_usuario }}</h2>
    <p>Rol: {{ $usuario->rol }}</p>
</body>
</html>
