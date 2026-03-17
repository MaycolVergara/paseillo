<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        // 1. Buscamos al usuario por su nombre
        $usuario = \App\Models\User::where('user', $request->user)->first();

        // 2. ¿Existe el usuario?
        if ($usuario) {
            // 3. Comparamos la clave escrita con la encriptada de la base de datos
            if (Hash::check($request->password, $usuario->password)) {

                // 4. ¡Correcto! Iniciamos sesión
                Auth::login($usuario);
                $request->session()->regenerate();

                // 5. Redirección por ROL
                return $usuario->rol == 1
                    ? redirect()->intended('/dashboard')
                    : redirect()->intended('/dashboard/mesasView');
            }
        }

        // Si algo falla
        return back()->withErrors(['user' => 'Usuario o contraseña incorrectos.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
