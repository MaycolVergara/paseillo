<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductModel extends Model
{
    use SoftDeletes;


    //  Nombre de la tabla
    protected $table = 'products';

    // Tu llave primaria
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'description',
        'date',
        'category_id',
        'stores_id'
    ];

    public function category()
    {
        //CONEXTAS CON CATEGORYA Y DE ACA SACAS SU ID Y NOMBRE
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }


}

