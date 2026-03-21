<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'username', 'password', 'role_id'];

    public function assignedRole()
    {
        // Relacionamos el campo 'role_id' de users con el 'id' de la tabla roles
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function username()
    {
        return 'username';
    }
}
