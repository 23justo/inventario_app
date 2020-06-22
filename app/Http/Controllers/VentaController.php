<?php

namespace App\Http\Controllers;

use App\Venta;
use App\VentaDetalle, App\Producto, App\User, App\Categoria, App\Sucursal;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    public function filter(){
        $user = auth('api')->user();
        $user = User::find($user['id']);
        $productos;

        if($user['sucursal_id']){
            $categorias = Categoria::where('sucursal_id',$user['sucursal_id'])->pluck('id')->toArray();
            $productos = Producto::whereIn('categoria_id',$categorias)->pluck('id')->toArray();

        }

        else if($user['supermercado_id']){
            $sucursales = Sucursal::where('supermercado_id',$user['supermercado_id'])->pluck('id')->toArray();
            $categorias = Categoria::whereIn('sucursal_id',$sucursales)->pluck('id')->toArray();
            $productos = Producto::whereIn('categoria_id',$categorias)->pluck('id')->toArray();
        }
        else
            $productos = Producto::get()->pluck('id')->toArray();
        
        return $productos;
    }

    public function filter_venta(){
        $productos = $this->filter();
        $detalle_venta = VentaDetalle::whereIn('producto_id',$productos)->pluck('venta_id')->toArray();
        return array_unique($detalle_venta);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = $this->filter_venta();
        return response()->json(Venta::whereIn('id',$ventas)->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = $this->filter();

        if($request->has('lines')){            
            foreach( $request['lines'] as $line){
                if( !array_search($line['producto_id'], $productos))
                    return response()->json('Producto no permitido',403);    
            }
        }
        else
            return response()->json('',403);
            

        $data = $request->all();        
        $venta = Venta::create($data);
        $productos_ids = array();
        $cantidades = array();

        foreach( $request['lines'] as $line){
            $line['venta_id'] = $venta['id'];
            $detalle_venta = VentaDetalle::create($line);
            array_push($productos_ids, $line['producto_id']);
            $cantidades[$line['producto_id']] = $line['cantidad'];
        }

            foreach($productos_ids as $id){
            $producto = Producto::find($id);
            $producto['existencias'] -= $cantidades[$id];
            $producto->update();
        }

        return response()->json($venta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        $ventas = $this->filter_venta();
        $indice = array_search($venta['id'], $ventas);
        if(is_numeric($indice)){

            $venta = Venta::find($venta['id']);
            $venta['lineas'] = $venta->detalle_venta();
            return response()->json($venta, 200);
        }
        else
            return response()->json("no tienes permisos para ver esta venta", 406);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $ventas = $this->filter_venta();
        $indice = array_search($venta['id'], $ventas);
        if(is_numeric($indice)){
            $detalles = $venta->detalle_venta();
            foreach ($detalles as $detalle_venta){
                $producto = Producto::find($detalle_venta['producto_id']);
                $producto['existencias'] += $detalle_venta["cantidad"];
                $producto->update();
                $detalle_venta->delete();
            }
            $venta->delete();
            
            return response()->json($venta, 204);
        }
        else{
            return response()->json("no tienes permisos para eliminar esta venta", 403);
        }
    }
}
