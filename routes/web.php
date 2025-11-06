<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'mostrarLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');
