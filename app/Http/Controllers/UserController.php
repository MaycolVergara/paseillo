<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Muestra a toda la gente que chambea en Paseillo
    public function index()
    {
        // Trae a los usuarios con su cargo (Admin, Mozo) de un solo golpe
        $users = User::with('assignedRole')->get();
        $roles = Role::all();

        return view('userRegistration', compact('users', 'roles'));
    }

    // Registra a un nuevo trabajador
    public function createUser(Request $request)
    {
        // Revisa que no dejen campos vacíos y que el correo no esté repetido
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

        // OJO: Encripta la clave para que nadie la vea en la base de datos
        $user->password = Hash::make($request->password);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect('/dashboard/userRegistration');
    }

    // Cambia los datos de alguien que ya está registrado
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        // Si escribiste una clave nueva, la cambia. Si no, deja la que ya tenía.
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/dashboard/userRegistration')->with('success', 'User updated successfully');
    }

    // Borra al usuario si ya no trabaja en el local
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/dashboard/userRegistration');
    }
}
