<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('categorias', function( Blueprint $table) {
            $table->dropForeign(['sucursal_id']);
        });
        Schema::dropIfExists('categorias');
    }
}
