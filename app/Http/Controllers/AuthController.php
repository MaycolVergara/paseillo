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
            'username' => 'required', // Antes 'user'
            'password' => 'required'
        ]);

        // 1. Buscamos al usuario por su username
        $user = User::where('username', $request->username)->first();

        // 2. ¿Existe el usuario?
        if ($user) {
            // 3. Comparamos la clave escrita con la encriptada de la base de datos
            if (Hash::check($request->password, $user->password)) {

                // 4. ¡Correcto! Iniciamos sesión
                Auth::login($user);
                $request->session()->regenerate();

                // 5. Redirección por ROL (Cambiamos 'rol_id' por 'role_id')
                if ($user->role_id == 1) {
                    return redirect()->intended('/dashboard');
                } else {
                    return redirect()->intended('/dashboard/tableView'); // Antes /dashboard/mesasView
                }
            }
        }

        // Si algo falla
        return back()->withErrors(['username' => 'Invalid username or password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
