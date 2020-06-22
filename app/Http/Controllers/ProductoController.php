<?php

namespace App\Http\Controllers;

use App\Producto;
use App\User;
use App\Categoria;
use App\Sucursal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{

    public function filter(){
        $user = auth('api')->user();
        $user = User::find($user['id']);
        $categorias;
        if($user['sucursal_id'])
            $categorias = Categoria::where('sucursal_id',$user['sucursal_id'])->pluck('id')->toArray();
        else if($user['supermercado_id']){
            $sucursales = Sucursal::where('supermercado_id',$user['supermercado_id'])->pluck('id')->toArray();
            $categorias = Categoria::whereIn('sucursal_id',$sucursales)->pluck('id')->toArray();
        }
        else
            $categorias = Categoria::get()->pluck('id')->toArray();
        
        return $categorias;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->filter();
        return response()->json(Producto::WhereIn('categoria_id',$categorias)->get(), 200);
        
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
        $categorias = $this->filter();
        if(array_search($request['categoria_id'], $categorias)){
            $producto = Producto::create($request->all());
            return response()->json($producto, 201);
        }
        return response()->json(
            array(
                "mensaje" => "Categoria no permitida"
            ),
            406

        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)    
    {
        $categorias = $this->filter();
        if(array_search($producto['categoria_id'], $categorias)){
            return response()->json(Producto::find($producto['id']), 200);
        }
        return response()->json(
            array(
                "mensaje" => "Accion no permitida"
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $categorias = $this->filter();
        
        if(array_search($producto['categoria_id'], $categorias)){
            $producto->update($request->all());
            return response()->json($producto, 200);
        }
        return response()->json(
            array(
                "mensaje" => "Accion no permitida"
            ),
            406
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $categorias = $this->filter();

        if(array_search($producto['categoria_id'], $categorias)){
            $producto->delete();
            return response()->json(null, 204);
        }
        return response()->json(
            array(
                "mensaje" => "Accion no permitida"
            )
        );
        
    }
}
