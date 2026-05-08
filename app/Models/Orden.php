<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'user_id',
        'estado',
        'total',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con detalles
    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class, 'orden_id');
    }
}
