<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes';

    protected $fillable = [
        'orden_id',
        'platillo_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con orden
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    // Relación con platillo
    public function platillo()
    {
        return $this->belongsTo(Platillo::class, 'platillo_id');
    }
}
