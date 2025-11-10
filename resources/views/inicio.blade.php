@extends('layouts.app')

@section('titulo', 'Panel de Control')

@section('contenido')
  <p class="text-muted mb-4">Selecciona una opción para continuar</p>
  <a href="{{ route('movimientos') }}" class="btn btn-dashboard btn-movimientos">
    <i class="fas fa-arrow-right-arrow-left mr-2"></i> Entradas y Salidas
  </a>
  <a href="{{ route('reporteMensual') }}" class="btn btn-dashboard btn-reportes">
    <i class="fas fa-chart-line mr-2"></i> Reportes y Gráficos
  </a>
@endsection