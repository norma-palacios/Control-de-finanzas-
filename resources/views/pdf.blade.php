<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Mensual</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f2f2f2; }
        h2, h3 { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <h2>Reporte Mensual {{ $fechaInicio }} / {{ $fechaFin }}</h2>

    <h3>Entradas</h3>
    <table>
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
                    <td class="text-right">${{ number_format($m->monto, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">TOTAL</th>
                <th class="text-right">${{ number_format($totalEntradas, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <h3>Salidas</h3>
    <table>
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
                    <td class="text-right">${{ number_format($m->monto, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">TOTAL</th>
                <th class="text-right">${{ number_format($totalSalidas, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <p><strong>Balance Mensual:</strong> ${{ number_format($balance, 2) }}</p>

</body>
</html>