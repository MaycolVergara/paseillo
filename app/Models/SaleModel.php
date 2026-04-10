<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'date',
        'total',
        'table_id',
        'table_number',
        'status'];
}
