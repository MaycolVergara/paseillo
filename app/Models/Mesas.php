<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table = 'mesas';

    protected $primaryKey = 'id_mesa';

    protected $fillable = [
        'numero_mesa',
        'estado',
        'id_usuario_atendiendo'
    ];

    public function usuarioAsignado()
    {
        return $this->belongsTo(User::class, 'id_usuario_atendiendo', 'id_usuario');
    }
}
