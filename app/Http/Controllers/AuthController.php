<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Proceso de entrada: Valida que el usuario y la clave coincidan con la BD.
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Busca al trabajador por su nombre de usuario.
        $user = UserModel::where('username', $request->username)->first();

        if ($user) {
            // SEGURIDAD: Hash::check compara la clave escrita con la encriptada.
            if (Hash::check($request->password, $user->password)) {

                // Crea la sesión oficial del usuario en el sistema.
                Auth::login($user);
                $request->session()->regenerate();

                // LÓGICA DE ACCESO: Si es Admin (1) va al Dashboard, si es Mozo va a las Mesas.
                if ($user->role_id == 1) {
                    return redirect()->intended('/dashboard');
                } else {
                    return redirect()->intended('/dashboard/tableView');
                }
            }
        }

        // Si falló, lo regresa con un mensaje de error.
        return back()->withErrors(['username' => 'Por fabor ingrese nuevamente.']);
    }

    // 2. Proceso de salida: Cierra la sesión y manda al usuario de vuelta al login.
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
