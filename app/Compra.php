<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompraDetalle;


class Compra extends Model
{
    protected $fillable = [
        'fecha',
    ];

    public function detalle_compras(){
        return $this->hasMany('App\CompraDetalle','compra_id','id')->get();
    }
}
