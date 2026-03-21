<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    // 1. Nombre de la tabla en inglés
    protected $table = 'sale_details';

    // 2. Llave primaria (id_detalle -> id)
    protected $primaryKey = 'id';

    // 3. Campos permitidos en inglés
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
        'customization'
    ];
}
