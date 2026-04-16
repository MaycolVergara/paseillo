<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
        'total',
        'table_delivery_id',
        'table_id',
        'table_number',
        'status',
        'payment_method',
        'customer_phone',
        'delivery_address',
        'receipt_type',
        'print_format'
    ];

    // conexión: Una venta pertenece a un cliente
    public function customer()
    {
        return $this->belongsTo(CustomerBallotModel::class, 'customer_id');
    }
}
