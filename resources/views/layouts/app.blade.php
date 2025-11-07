<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo') | Control de Finanzas</title>

  <!-- AdminLTE + Bootstrap + FontAwesome desde CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Inicio</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="nav-link text-muted">Bienvenido, {{ session('usuario')->nombre_usuario ?? 'Usuario' }}</span>
      </li>
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link text-danger">
          <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
      <span class="brand-text">💼 Control Finanzas</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('inicio') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('movimientos') }}" class="nav-link {{ request()->is('movimientos') ? 'active' : '' }}">
              <i class="nav-icon fas fa-arrow-right-arrow-left"></i>
              <p>Entradas y Salidas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('reportes') }}" class="nav-link {{ request()->is('reportes') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Reportes y Gráficos</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Contenido principal -->
  <div class="content-wrapper p-4 text-center">
    <h1>@yield('titulo')</h1>
    <hr>
    @yield('contenido')
  </div>

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>© {{ date('Y') }} Control de Finanzas.</strong> Todos los derechos reservados.
  </footer>

</div>
</body>
</html>