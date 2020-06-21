<?php

namespace App\Http\Controllers;

use App\Supermercado;
use Illuminate\Http\Request;

class SupermercadoController extends Controller
{
  

    public function index()
    {   

            return response()->json(Supermercado::get(), 200);
        
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
        return response()->json(Supermercado::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supermercado  $supermercado
     * @return \Illuminate\Http\Response
     */
    public function show(Supermercado $supermercado)
    {
        return response()->json(Supermercado::find($supermercado), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supermercado  $supermercado
     * @return \Illuminate\Http\Response
     */
    public function edit(Supermercado $supermercado)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supermercado  $supermercado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supermercado $supermercado)
    {
        $supermercado->update($request->all());
        return response()->json($supermercado, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supermercado  $supermercado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supermercado $supermercado)
    {
        $supermercado->delete();
        return response()->json('Supermercado eliminado', 204);
    }
}
