<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetailModel extends Model
{
    //  Nombre de la tabla
    protected $table = 'sale_details';

    //  Llave primaria
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    //  Campos permitidos
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
        'customization'
    ];
}
