<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBallotModel extends Model
{
    protected $table = 'customer_ballot';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'surname', 'dni', 'phone'];

    // Un cliente tiene muchas ventas
    public function sales()
    {
        // Especificamos 'customer_id' porque es el nombre de la columna en la tabla 'sales'
        return $this->hasMany(SaleModel::class, 'customer_id');
    }
}
