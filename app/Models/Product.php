<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;


    //  Nombre de la tabla
    protected $table = 'products';

    // Tu llave primaria
    protected $primaryKey = 'id';

    // Desactivamos las fechas automáticas
    public $timestamps = false;

    public function category()
    {
        //CONEXTAS CON CATEGORYA Y DE ACA SACAS SU ID Y NOMBRE
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected $fillable = [
        'name',
        'price',
        'description',
        'delivery_date',
        'image',
        'category_id'
    ];
}
