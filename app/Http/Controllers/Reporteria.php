<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sucursal, App\User, App\Producto, App\Categoria;

class Reporteria extends Controller
{

    public function sucursales(){
        $user = auth('api')->user();
        $user = User::find($user['id']);
        
        $sucursales = array();

        if($user['sucursal_id']){
            return array($user['sucursal_id']);
        }

        else if($user['supermercado_id'])
            $sucursales = Sucursal::where('supermercado_id',$user['supermercado_id'])->pluck('id')->toArray();
        
        else
            $sucursales = Sucursal::get()->pluck('id')->toArray();

        return $sucursales;
    }

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

    public function filter_categorias($id){
        $user = auth('api')->user();
        $user = User::find($user['id']);

        if($user['sucursal_id'] && $user['sucursal_id'] == $id ){
            $categorias = Categoria::where('sucursal_id',$id)->pluck('id')->toArray();

        }

        else if($user['supermercado_id']){
            $sucursales = Sucursal::where('supermercado_id',$user['supermercado_id'])->pluck('id')->toArray();
            $categorias = Categoria::whereIn('sucursal_id',$sucursales)->pluck('id')->toArray();

        }
        else{
            $categorias = Categoria::get()->pluck('id')->toArray();
            
        }
        
        return $categorias;

    }

    public function index(Sucursal $sucursal){
        $categorias = $this->filter_categorias($sucursal['id']);
        if(count($categorias) > 0 )
            return response()->json(Producto::whereIn('categoria_id', $categorias)->get(), 200);
        else
            return response()->json(array('No tienes acceso a esta informacion'), 406);
    }

    public function productos_por_sucursal(){
        $data_reporte = array();
        $sucursales = $this->sucursales();
        $sucursales = Sucursal::whereIn('id',$sucursales)->get();
        
        foreach ($sucursales as $index_sucursal => $sucursal){

            $categorias = Categoria::where('sucursal_id', $sucursal['id'])->get();
            
            foreach($categorias as $index_categoria => $categoria){

                $productos = Producto::where('categoria_id', $categoria['id'])->get();
                
                foreach($productos as $index_producto => $producto){
                    $data_reporte[$categoria['nombre']]['productos'][$index_producto] = array("nombre" => $producto['nombre'], "existencias" => $producto['existencias'] );
                }
            }

        }
        return response()->json($data_reporte, 200);
    }

    

}
