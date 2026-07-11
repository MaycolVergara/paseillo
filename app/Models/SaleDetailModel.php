<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetailModel extends Model
{
    use SoftDeletes;
    //  Nombre de la tabla
    protected $table = 'sale_details';

    //  Llave primaria
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id')->withTrashed();
    }

    public function sale()
    {
        return $this->belongsTo(SaleModel::class, 'sale_id');
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
