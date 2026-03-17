<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['nombre', 'correo', 'user', 'password', 'rol'];

    // 🌟 ESTA ES LA FUNCIÓN QUE FALTABA
    public function rolAsignado()
    {
        // Relacionamos el campo 'rol' de usuarios con el 'id_rol' de la tabla roles
        return $this->belongsTo(Rol::class, 'rol', 'id_rol');
    }

    public function username()
    {
        return 'user';
    }
}
