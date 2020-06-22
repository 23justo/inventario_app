<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'supermercado_id',
    ];
}
