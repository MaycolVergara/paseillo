<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use Database\Seeders\RolSeeder;
class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin Principal
        UserModel::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role_id'  => 1, // Admin
            ]
        );
    }
}
