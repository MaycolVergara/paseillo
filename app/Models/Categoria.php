<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'categorias';

    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre_categoria']; // 👈 Esto le da permiso de guardarse
}
