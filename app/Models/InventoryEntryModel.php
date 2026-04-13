<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryEntryModel extends Model
{
    use HasFactory;

    protected $table = 'inventory_entries';

    protected $fillable = [
        'store_id',
        'quantity',
        'entry_date',
        'notes',
    ];

    public function supply()
    {
        return $this->belongsTo(StoreModel::class, 'store_id');
    }
}
