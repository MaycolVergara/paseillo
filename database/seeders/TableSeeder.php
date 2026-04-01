<?php

namespace Database\Seeders;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'table_number'=>$i,
                'status'=>'disponible'
            ]);
        }

    }
}
