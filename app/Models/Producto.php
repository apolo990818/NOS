<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en la BD

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'image',
        'usuario_id' // Agregado para permitir asignación masiva
    ];

    /**
     * Relación con el usuario que creó el producto.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
