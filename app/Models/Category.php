<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Nombre de la tabla
    protected $table = 'categories';

    // Llave primaria
    protected $primaryKey = 'id';


    protected $fillable = ['name'];
}
