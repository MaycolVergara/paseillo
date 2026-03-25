<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\TableDelivey;

class TableDelivery extends Model
{
    protected $table = 'table_delivery';
    protected $primaryKey = 'id';
    protected $fillable = [
        'table_number',
        'status',
        'user_id'
    ];
}
