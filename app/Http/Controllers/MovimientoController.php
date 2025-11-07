<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class MovimientoController extends Controller
{
    
    // Función privada para verificar la sesion antes de cada accion.
     
    private function verificarSesion()
    {
        if (!session()->has('usuario')) {
            // Usamos 'force' para redirigir inmediatamente
            return Redirect::to('/')->with('error', 'Debes iniciar sesión.');
        }
        return null;
    }
    
     //Muestra la pagina principal de movimientos con formularios y tablas.
     
    public function index()
    {
        if ($redirect = $this->verificarSesion()) { return $redirect; } // <-- Verificación
        
        $usuario_id = session('usuario')->id;

        // Obtenemos los movimientos del usuario logueado
        $entradas = Movimiento::where('usuario_id', $usuario_id)
                            ->where('tipo', 'ENTRADA')
                            ->orderBy('fecha', 'desc')
                            ->get();

        $salidas = Movimiento::where('usuario_id', $usuario_id)
                           ->where('tipo', 'SALIDA')
                           ->orderBy('fecha', 'desc')
                           ->get();

        return view('movimientos', compact('entradas', 'salidas'));
    }

    
     // Procesa el formulario de "Registrar Entrada".
    
    public function registrarEntrada(Request $request)
    {
        if ($redirect = $this->verificarSesion()) { return $redirect; } 

        // Validamos y guardamos usando una funcion helper
        $this->registrarMovimiento($request, 'ENTRADA');

        // Redirigimos de vuelta con un mensaje de exito
        return Redirect::route('movimientos')->with('success_entrada', '¡Entrada registrada con exito!');
    }

    /**
     * Procesa el formulario de "Registrar Salida".
     */
    public function registrarSalida(Request $request)
    {
        if ($redirect = $this->verificarSesion()) { return $redirect; } // <-- Verificación

        // Validamos y guardamos usando una funcioon helper
        $this->registrarMovimiento($request, 'SALIDA');

        // Redirigimos de vuelta con un mensaje de exito
        return Redirect::route('movimientos')->with('success_salida', '¡Salida registrada con exito!');
    }

    /**
     * Funcion privada para registrar ambos tipos de movimiento.
     */
    private function registrarMovimiento(Request $request, string $tipo)
    {
        // 1. Validacion
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'factura' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB Max
        ]);

        // 2. Preparar datos
        $datos = $request->only(['descripcion', 'monto', 'fecha']);
        $datos['tipo'] = $tipo;
        $datos['usuario_id'] = session('usuario')->id; 

        // 3. Manejar subida de factura
        if ($request->hasFile('factura')) {
            $ruta = $request->file('factura')->store('facturas', 'public');
            $datos['factura_url'] = $ruta;
        }

        // 4. Guardar en la base de datos
        Movimiento::create($datos);
    }
}