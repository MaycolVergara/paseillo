<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle';

    // Fíjate que uso los nombres exactos de tu tabla
    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'precio_unitario', 'subtotal', 'personalizado'];
}
