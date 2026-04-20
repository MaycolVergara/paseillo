<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'surname', 'phone', 'dni', 'email', 'address', 'salary', 'advance_payment', 'position', 'is_active', 'hire_date', 'payment_day'
    ];

    public function absences()
    {
        return $this->hasMany(StaffAbsenceModel::class, 'staff_id');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'staff_id');
    }
}
