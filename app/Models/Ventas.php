<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    // Los campos que podemos llenar directamente
    protected $fillable = ['id_usuario', 'fecha', 'total', 'id_mesa', 'numero_mesa', 'estado'];
}
