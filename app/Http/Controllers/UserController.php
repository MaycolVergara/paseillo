<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role; // Antes Rol
use Illuminate\Support\Facades\Hash;

class UserController extends Controller // Antes UsuariosController
{
    public function index()
    {
        // Usamos la relación 'assignedRole' que definimos en el modelo User
        $users = User::with('assignedRole')->get();
        $roles = Role::all();
        return view('userRegistration', compact('users', 'roles')); // Antes usuariosRegistro
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        // 🌟 Encriptamos la contraseña correctamente
        $user->password = Hash::make($request->password);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect('/dashboard/userRegistration');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        // ✅ Solo actualizamos la contraseña si el usuario escribió algo
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/dashboard/userRegistration')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/dashboard/userRegistration');
    }
}
