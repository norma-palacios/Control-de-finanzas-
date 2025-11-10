<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function reporteMensual(Request $request)
    {
        // Fechas del reporte (por defecto, mes actual)
        $fechaInicio = $request->input('inicio', date('Y-m-01'));
        $fechaFin = $request->input('fin', date('Y-m-t'));

        // Consultar movimientos
        $movimientos = DB::table('movimientos')
            ->select('tipo', 'monto', 'descripcion', 'fecha')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        // Calcular totales
        $totalEntradas = $movimientos->where('tipo', 'ENTRADA')->sum('monto');
        $totalSalidas = $movimientos->where('tipo', 'SALIDA')->sum('monto');
        $balance = $totalEntradas - $totalSalidas;

        return view('reportes', compact(
            'movimientos', 'fechaInicio', 'fechaFin', 'totalEntradas', 'totalSalidas', 'balance'
        ));
    }
}
