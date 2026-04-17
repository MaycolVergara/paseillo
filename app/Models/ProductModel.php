<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductModel extends Model
{
    use SoftDeletes;


    //  Nombre de la tabla
    protected $table = 'products';

    // Tu llave primaria
    protected $primaryKey = 'id';

    // Desactivamos las fechas automáticas
    public $timestamps = false;

    public function category()
    {
        //CONEXTAS CON CATEGORYA Y DE ACA SACAS SU ID Y NOMBRE
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    /**
     * Genera la URL pública de la imagen del producto.
     * En producción (S3/R2): devuelve la URL del bucket.
     * En local (public disk): devuelve asset('storage/...').
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // Si el disco configurado es S3 (R2/Cloud), usamos Storage::url
        if (config('filesystems.default') === 's3') {
            return Storage::disk('s3')->url($this->image);
        }

        // En local, usamos el symlink de storage
        return asset('storage/' . $this->image);
    }

    protected $fillable = [
        'name',
        'price',
        'description',
        'delivery_date',
        'image',
        'category_id',
        'stores_id'
    ];
}

