<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'fecha',
    ];

    public function detalle_ventass(){
        return $this->hasMany('App\VentaDetalle','venta_id','id')->get();
    }
}
