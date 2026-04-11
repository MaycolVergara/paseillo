<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAbsenceModel extends Model
{
    use HasFactory;

    protected $table = 'staff_absences';

    protected $fillable = [
        'staff_id',
        'absence_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'absence_date' => 'date',
    ];

    public function staff()
    {
        return $this->belongsTo(StaffModel::class, 'staff_id');
    }
}
