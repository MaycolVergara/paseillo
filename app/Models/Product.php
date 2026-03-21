<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    // 1. Nombre de la tabla en inglés
    protected $table = 'products';

    // 2. Tu llave primaria (id_producto -> id)
    protected $primaryKey = 'id';

    // 3. Desactivamos las fechas automáticas según tu código
    public $timestamps = false;

    // 4. Campos permitidos en inglés
    protected $fillable = [
        'name',
        'price',
        'description',
        'delivery_date',
        'category_id'
    ];
}
