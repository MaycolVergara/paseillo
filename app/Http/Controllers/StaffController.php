<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\StaffModel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Muestra la vista de staffRegistration
    public function index()
    {
        $staffMembers = StaffModel::all();
        $roles = RoleModel::all();

        return view('staffList', compact('staffMembers', 'roles'));
    }

    public function viewForm()
    {
        $roles = RoleModel::all();
        return view('staffRegistration', compact('roles'));
    }

    // Registra a un nuevo trabajador
    public function store(Request $request)
    {
        // 1. Validación estricta
        $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'dni' => 'required|string|max:15|unique:staff,dni', // Evita DNIs duplicados
            'salary' => 'required|numeric|min:0',
            'position' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100', // Validamos que sea un correo real
            'address'     => 'nullable|string|max:100',
            'hire_date'   => 'nullable|date',
            'payment_day' => 'nullable|integer|min:1|max:31',
            'advance_payment' => 'nullable|numeric|min:0',
        ], [
            // Mensajes personalizados para que sepas qué pasó
            'dni.unique' => 'Ese DNI ya está registrado en el sistema.',
            'salary.numeric' => 'El sueldo debe ser un número válido.',
        ]);

        // 2. Intento de creación
        try {
            StaffModel::create([
                'name'        => $request->name,
                'surname'     => $request->surname,
                'dni'         => $request->dni,
                'salary'      => $request->salary,
                'position'    => $request->position,
                'phone'       => $request->phone,
                'email'       => $request->email,
                'address'     => $request->address,
                'hire_date'   => $request->hire_date,
                'payment_day' => $request->payment_day,
                'is_active'   => true,
            ]);

            return redirect('/dashboard/staffList')->with('success', 'Trabajador registrado con éxito.');

        } catch (\Exception $e) {
            // Si hay un error de base de datos, vuelve atrás con el mensaje de error
            return redirect()->back()->withInput()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    // Muestra el formulario de edición con los datos del trabajador
    public function viewEdit($id)
    {
        $staff = StaffModel::findOrFail($id);
        return view('staffEdit', compact('staff'));
    }

    // Actualiza los datos del trabajador
    // Actualiza los datos del trabajador
    public function update(Request $request, $id)
    {
        $staff = StaffModel::findOrFail($id);

        // 1. Validamos también los campos nuevos
        $request->validate([
            'name'        => 'required|string|max:50',
            'surname'     => 'required|string|max:50',
            'dni'         => 'required|string|max:15|unique:staff,dni,' . $id,
            'salary'      => 'required|numeric|min:0',
            'position'    => 'required|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
            'address'     => 'nullable|string|max:100', // Agregado
            'hire_date'   => 'nullable|date',           // Agregado
            'payment_day' => 'nullable|integer|min:1|max:31', // Agregado
            'advance_payment' => 'nullable|numeric|min:0',
        ], [
            'dni.unique' => 'Ese DNI ya está registrado en otro trabajador.',
            'salary.numeric' => 'El sueldo debe ser un número válido.',
        ]);

        // 2. Guardamos TODOS los campos
        $staff->update([
            'name'        => $request->name,
            'surname'     => $request->surname,
            'dni'         => $request->dni,
            'salary'      => $request->salary,
            'position'    => $request->position,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'address'     => $request->address,     // Agregado
            'hire_date'   => $request->hire_date,   // Agregado
            'payment_day' => $request->payment_day, // Agregado
        ]);

        return redirect('/dashboard/staffList')->with('success', 'Datos actualizados correctamente.');
    }

    // Activa o desactiva al personal (Mozo que ya no trabaja, etc.)
    public function toggleStatus($id)
    {
        $staff = StaffModel::findOrFail($id);
        $staff->is_active = !$staff->is_active;
        $staff->save();

        return redirect('/dashboard/staffList');
    }
}
