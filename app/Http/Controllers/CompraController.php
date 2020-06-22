<?php

namespace App\Http\Controllers;

use App\Compra, App\CompraDetalle, App\Producto, App\User, App\Categoria, App\Sucursal;
use Illuminate\Http\Request;

class CompraController extends Controller
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

    public function filter_compra(){
        $productos = $this->filter();
        $detalle_compra = CompraDetalle::whereIn('producto_id',$productos)->pluck('compra_id')->toArray();
        return array_unique($detalle_compra);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = $this->filter_compra();
        return response()->json(Compra::whereIn('id',$compras)->get(), 200);
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
        $compra = Compra::create($data);
        $productos_ids = array();
        $cantidades = array();

        foreach( $request['lines'] as $line){
            $line['compra_id'] = $compra['id'];
            $detalle_compra = CompraDetalle::create($line);
            array_push($productos_ids, $line['producto_id']);
            $cantidades[$line['producto_id']] = $line['cantidad'];
        }

            foreach($productos_ids as $id){
            $producto = Producto::find($id);
            $producto['existencias'] += $cantidades[$id];
            $producto->update();
        }

        return response()->json($compra, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compras = $this->filter_compra();
        $indice = array_search($compra['id'], $compras);
        if(is_numeric($indice)){

            $compra = Compra::find($compra['id']);
            $compra['lineas'] = $compra->detalle_compras();
            return response()->json($compra, 200);
        }
        else
            return response()->json("no tienes permisos para ver esta compra", 403);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        $compras = $this->filter_compra();
        $indice = array_search($compra['id'], $compras);
        if(is_numeric($indice)){
            $detalles = $compra->detalle_compras();
            foreach ($detalles as $detalle_compra){
                $producto = Producto::find($detalle_compra['producto_id']);
                $producto['existencias'] -= $detalle_compra["cantidad"];
                $producto->update();
                $detalle_compra->delete();
            }
            $compra->delete();
            
            return response()->json($compra, 204);
        }
        else{
            return response()->json("no tienes permisos para eliminar esta compra", 403);
        }
    }
}
