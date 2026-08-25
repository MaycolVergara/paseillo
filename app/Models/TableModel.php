<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableModel extends Model
{
    // Nombre de la tabla
    protected $table = 'tables';

    // Llave primaria
    protected $primaryKey = 'id';

    // Campos permitidos
    protected $fillable = [
        'table_number',
        'status',

    ];

    // Relación / Accesor: quién está atendiendo esta mesa
    public function getServingUserAttribute()
    {
        $sale = SaleModel::with('user.staff')
            ->where('status', 'Pending')
            ->where(function($query) {
                $query->where('table_number', $this->table_number)
                      ->orWhere('table_id', $this->table_number)
                      ->orWhere('table_id', $this->id);
            })
            ->latest('id')
            ->first();

        return $sale ? $sale->user : null;
    }
}
