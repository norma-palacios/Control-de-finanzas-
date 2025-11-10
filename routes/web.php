<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovimientoController;

Route::get('/', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');

Route::get('/inicio', function () {
    if (!session('usuario')) {
        return redirect('/')->with('error', 'Por favor inicia sesión primero.');
    }

    $usuario = session('usuario');
    return view('inicio', compact('usuario'));
})->name('dashboard');

Route::get('/logout', function () {
    // Borrar todos los datos guardados en sesión
    session()->flush();

    // Redirigir al login con un mensaje
    return redirect('/')->with('mensaje', 'Has cerrado sesión correctamente.');
})->name('logout');

// Middleware para proteger las rutas
Route::middleware('web')->group(function () {

    // Muestra formularios y tablas
    Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos');
    
    // Procesa el formulario de entrada
    Route::post('/movimientos/entrada', [MovimientoController::class, 'registrarEntrada'])->name('movimientos.entrada');

    // Procesa el formulario de salida
    Route::post('/movimientos/salida', [MovimientoController::class, 'registrarSalida'])->name('movimientos.salida');
});

Route::get('/reportes', function () {
    if (!session()->has('usuario')) {
        return redirect('/')->with('error', 'Debes iniciar sesión.');
    }
    $usuario = session('usuario');
    return view('reportes', compact('usuario'));
})->name('reportes');
