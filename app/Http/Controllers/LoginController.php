<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function mostrarLogin()
    {
        return view('login');
    }

    public function autenticar(Request $request)
    {
        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)
                          ->where('contrasena', $request->contrasena)
                          ->first();

        if ($usuario) {
            return view('inicio', ['usuario' => $usuario]);
        } else {
            return back()->with('error', 'Usuario o contraseña incorrectos.');
        }
    }
}
