<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // 1. PRIMERO: Creamos el rol número 1 en la tabla de roles
        DB::table('roles')->insert([
            'id_rol' => 1,
            'rol' => 'administrador',
        ]);

        // 2. SEGUNDO: Ahora sí creamos tu usuario, porque el rol 1 ya existe
        User::create([
            'nombre'   => 'administrador',
            'correo'   => 'administradorPorDefecto@gmail.com',
            'user'     => 'administradorPorDefecto',
            'password' => Hash::make('administradorPorDefecto'),
            'rol'      => 1,
        ]);
    }
}
