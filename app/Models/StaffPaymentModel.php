<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPaymentModel extends Model
{
    protected $table = 'staff_payments';
    
    protected $fillable = [
        'staff_id', 
        'payment_type',
        'base_salary', 
        'advance_deducted', 
        'net_paid',
        'notes'
    ];

    public function staff()
    {
        return $this->belongsTo(StaffModel::class, 'staff_id');
    }
}
