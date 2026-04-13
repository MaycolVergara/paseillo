<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    // Nombre de la tabla
    protected $table = 'categories';

    // Llave primaria
    protected $primaryKey = 'id';


    protected $fillable = ['name', 'stores_id'];

    public function store()
    {
        return $this->belongsTo(StoreModel::class, 'stores_id');
    }
}
