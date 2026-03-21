<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Database\Seeders\RolSeeder;
class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Creamos el rol (Si no lo has creado en otro Seeder)
       /* DB::table('roles')->updateOrInsert(
            ['id' => 1],
            ['name' => 'administrador']
        );*/
        $this->call(RolSeeder::class);

        // 2. Creamos el usuario Admin corto
        User::create([
            'name'     => 'Admin Paseillo',
            'email'    => 'admin@paseillo.com',
            'username' => 'admin', // 👈 Ahora sí podrás entrar con "admin"
            'password' => Hash::make('admin123'), // 👈 Clave fácil para pruebas
            'role_id'  => 1,
        ]);
    }
}
