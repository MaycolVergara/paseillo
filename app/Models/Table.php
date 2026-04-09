<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // Nombre de la tabla
    protected $table = 'tables';

    // Llave primaria
    protected $primaryKey = 'id';

    // Campos permitidos
    protected $fillable = [
        'table_number',
        'status',
        'serving_user_id'
    ];

    // Relación: quién está atendiendo esta mesa
    public function servingUser()
    {
        return $this->belongsTo(User::class, 'serving_user_id', 'id');
    }
}
