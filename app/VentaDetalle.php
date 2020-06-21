<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $fillable = [
        'cantidad',
        'producto_id',
        'venta_id',
    ];
}
