<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // 1. Nombre de la tabla traducido
    protected $table = 'tables';

    // 2. Llave primaria (id_mesa -> id)
    protected $primaryKey = 'id';

    // 3. Campos permitidos traducidos
    protected $fillable = [
        'table_number',
        'status',
        'serving_user_id'
    ];

    public function assignedUser()
    {
        // Relacionamos 'serving_user_id' con el 'id' del modelo User
        return $this->belongsTo(User::class, 'serving_user_id', 'id');
    }
}
