@extends('layouts.app')

@section('titulo', 'Reportes y Gráficos')

@section('contenido')
  <div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Tabla de Entradas -->
            <div class="col-md-6">
                <h5>Entradas</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movimientos->where('tipo', 'ENTRADA') as $m)
                            <tr>
                                <td>{{ $m->fecha }}</td>
                                <td>{{ $m->descripcion }}</td>
                                <td>${{ number_format($m->monto, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">TOTAL</th>
                            <th>${{ number_format($totalEntradas, 2) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabla de Salidas -->
            <div class="col-md-6">
                <h5>Salidas</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movimientos->where('tipo', 'SALIDA') as $m)
                            <tr>
                                <td>{{ $m->fecha }}</td>
                                <td>{{ $m->descripcion }}</td>
                                <td>${{ number_format($m->monto, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">TOTAL</th>
                            <th>${{ number_format($totalSalidas, 2) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-3"><strong>Balance Mensual: </strong>${{ number_format($balance, 2) }}</p>
    </div>
</div>

<!-- Gráfico -->
<div class="card mt-3">
    <div class="card-body">
        <h5>Gráfico de balance mensual Entradas vs Salidas</h5>
        <canvas width = "200px" id="graficoBalance"></canvas>
    </div>
</div> 
<a href="{{ route('reportes.pdf', ['inicio' => $fechaInicio, 'fin' => $fechaFin]) }}" 
   class="btn btn-danger mb-3" target="_blank">
   <i class="fas fa-file-pdf"></i> Descargar PDF
</a>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficoBalance').getContext('2d');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Entradas', 'Salidas'],
        datasets: [{
            data: [{{ $totalEntradas }}, {{ $totalSalidas }}],
            backgroundColor: ['#36A2EB', '#FF6384'],
        }]
    },
    options: {
        responsive: true,
    }
});
</script>
@endsection 