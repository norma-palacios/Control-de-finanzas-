<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReporteController;

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

Route::get('/movimientos', function () {
    if (!session()->has('usuario')) {
        return redirect('/')->with('error', 'Debes iniciar sesión.');
    }
    $usuario = session('usuario');
    return view('movimientos', compact('usuario'));
})->name('movimientos');

Route::get('/reportes', [ReporteController::class, 'reporteMensual'])->name('reporteMensual');