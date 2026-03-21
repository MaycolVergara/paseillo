<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';

    // Los campos que podemos llenar directamente
    protected $fillable = ['user_id', 'date', 'total', 'table_id', 'table_number', 'status'];
}
