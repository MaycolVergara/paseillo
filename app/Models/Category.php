<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 1. Nombre de la tabla en inglés
    protected $table = 'categories';

    // 2. Llave primaria (id_categoria -> id)
    protected $primaryKey = 'id';

    // 3. Campos permitidos en inglés
    protected $fillable = ['name']; // id_categoria -> id, nombre_categoria -> name
}
