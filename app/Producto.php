<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'existencias',
        'precio_compra',
        'precio_venta',
        'categoria_id',
        'proveedor_id',
    ];
}
