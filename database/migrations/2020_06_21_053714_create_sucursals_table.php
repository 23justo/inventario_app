<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->unsignedBigInteger('supermercado_id');
            $table->foreign('supermercado_id')->references('id')->on('supermercados');
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
        Schema::table('sucursals', function( Blueprint $table) {
            $table->dropForeign(['supermercado_id']);
        });
        Schema::dropIfExists('sucursals');
    }
}
