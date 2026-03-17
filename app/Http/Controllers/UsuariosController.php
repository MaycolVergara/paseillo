<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rolAsignado')->get();
        $rols = Rol::all();
        return view('usuariosRegistro', compact('usuarios', 'rols'));
    }

    public function createUsuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'user' => 'required|unique:usuarios,user',
            'password' => 'required',
            'rol' => 'required'
        ]);

        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->user = $request->user;

        // 🌟 Encriptamos la contraseña correctamente
        $usuario->password = Hash::make($request->password);

        $usuario->rol = $request->rol;
        $usuario->save();

        return redirect('/dashboard/usuariosRegistro');
    }
    public function update(Request $request, $id_usuario)
    {
        $usuario = User::find($id_usuario);
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->user   = $request->user;
        $usuario->rol    = $request->rol;

        // ✅ CAMBIO 2: de 'clave' a 'password'
        // Solo actualizamos la contraseña si el usuario escribió algo en el campo
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();
        return redirect('/dashboard/usuariosRegistro')->with('success', 'Usuario actualizado correctamente');
    }

    public function delete($id_usuario)
    {
        $categoria = User::find($id_usuario);
        $categoria->delete();
        return redirect('/dashboard/usuariosRegistro');
    }

}
