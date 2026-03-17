<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    // 1. Le decimos el nombre exacto de la tabla
    protected $table = 'productos';

    // 2. LA LÍNEA MÁGICA: Le decimos cómo se llama tu ID real
    protected $primaryKey = 'id_producto';

    // 3. Desactivamos las fechas automáticas para evitar errores
    public $timestamps = false;

    // 4. Los campos que permitimos llenar
    protected $fillable = [
        'nombre_producto',
        'precio',
        'descripcion_producto',
        'fecha_entrega',
        'id_categoria'
    ];
}
