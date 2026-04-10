<?php

namespace Database\Seeders;
use App\Models\TableModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            TableModel::create([
                'table_number'=>$i,
                'status'=>'disponible'
            ]);
        }

    }
}
