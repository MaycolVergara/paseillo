<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreModel extends Model
{
    protected $table = 'stores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'current_stock',
        'minimum_stock',
        'unit'
    ];

}
