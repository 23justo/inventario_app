<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    protected $fillable = [
        'cantidad',
        'producto_id',
        'compra_id',
    ];
}
