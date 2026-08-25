<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['staff_id', 'username', 'password', 'role_id'];

    public function staff()
    {
        // Esto le dice a Laravel: "Busca mis datos reales en la tabla staff usando mi staff_id"
        return $this->belongsTo(StaffModel::class, 'staff_id');
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    public function getNameAttribute()
    {
        if ($this->staff && $this->staff->name) {
            return $this->staff->name;
        }
        return $this->username;
    }

    // Esto le dice a Laravel que usaremos 'username' para el login en vez de 'email'
    public function username()
    {
        return 'username';
    }
}
