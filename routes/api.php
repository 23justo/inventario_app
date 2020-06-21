<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//SUPERMERCADOS
Route::middleware('auth:api')->group( function () {
    
    Route::post('supermercados', 'SupermercadoController@store')->name('supermercado.store')
        ->middleware('can:supermercado.create');

    Route::get('supermercados', 'SupermercadoController@index')->name('supermercado.index')
        ->middleware('can:supermercado.index');

        Route::get('supermercados/{supermercado}', 'SupermercadoController@show')->name('supermercado.show')
        ->middleware('can:supermercado.show');

    
    Route::put('supermercados/{supermercado}', 'SupermercadoController@update')->name('supermercado.update')
        ->middleware('can:supermercado.update');
        
    Route::delete('supermercados/{supermercado}', 'SupermercadoController@destroy')->name('supermercado.destroy')
        ->middleware('can:supermercado.destroy');
    
});

//SUCURSALES
Route::middleware('auth:api')->group( function () {
    
    Route::post('sucursales', 'SucursalController@store')->name('sucursal.store')
        ->middleware('can:sucursal.create');

    Route::get('sucursales', 'SucursalController@index')->name('sucursal.index')
        ->middleware('can:sucursal.index');

        Route::get('sucursales/{sucursal}', 'SucursalController@show')->name('sucursal.show')
        ->middleware('can:sucursal.show');

    
    Route::put('sucursales/{sucursal}', 'SucursalController@update')->name('sucursal.update')
        ->middleware('can:sucursal.update');
        
    Route::delete('sucursales/{sucursal}', 'SucursalController@destroy')->name('sucursal.destroy')
        ->middleware('can:sucursal.destroy');
    
});


//CATEGORIAS
Route::middleware('auth:api')->group( function () {
    
    Route::post('categorias', 'CategoriaController@store')->name('categoria.store')
        ->middleware('can:categoria.create');

    Route::get('categorias', 'CategoriaController@index')->name('categoria.index')
        ->middleware('can:categoria.index');

        Route::get('categorias/{categoria}', 'CategoriaController@show')->name('categoria.show')
        ->middleware('can:categoria.show');

    
    Route::put('categorias/{categoria}', 'CategoriaController@update')->name('categoria.update')
        ->middleware('can:categoria.update');
        
    Route::delete('categorias/{categoria}', 'CategoriaController@destroy')->name('categoria.destroy')
        ->middleware('can:categoria.destroy');
});

//Productos
Route::middleware('auth:api')->group( function () {
    
    Route::post('productos', 'ProductoController@store')->name('producto.store')
        ->middleware('can:producto.store');

    Route::get('productos', 'ProductoController@index')->name('producto.index')
        ->middleware('can:producto.index');

    Route::get('productos/{producto}', 'ProductoController@show')->name('producto.show')
        ->middleware('can:producto.show');

    
    Route::put('productos/{producto}', 'ProductoController@update')->name('producto.update')
        ->middleware('can:producto.update');
        
    Route::delete('productos/{producto}', 'ProductoController@destroy')->name('producto.destroy')
        ->middleware('can:producto.destroy');
    
});