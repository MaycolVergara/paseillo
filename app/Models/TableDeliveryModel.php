<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableDeliveryModel extends Model
{
    protected  $table="tables_delivery";
    protected $primaryKey = 'id';

    // Campos permitidos
    protected $fillable = [
        'table_number',
        'status',
        'serving_user_id'
    ];
}
