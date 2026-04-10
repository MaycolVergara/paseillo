<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\StaffModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Muestra el formulario para crear el usuario a un Staff específico
    public function createCredentials($id)
    {
        $staff = StaffModel::findOrFail($id);
        $roles = RoleModel::all();

        return view('userCredentials', compact('staff', 'roles'));
    }

    // 2. Guarda el usuario y la contraseña en la BD
    public function storeCredentials(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role_id'  => 'required|exists:roles,id'
        ], [
            'username.unique' => 'Este nombre de usuario ya está en uso.',
        ]);

        UserModel::create([
            'staff_id' => $id, // Conectamos el usuario con el trabajador
            'username' => $request->username,
            'password' => Hash::make($request->password), // Encriptamos la clave
            'role_id'  => $request->role_id,
        ]);

        // Volvemos a la lista de personal con un mensaje de éxito
        return redirect('/dashboard/staffList')->with('success', 'Credenciales de acceso creadas correctamente.');
    }
}
