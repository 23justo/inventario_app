<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersSucursalSupermercado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->unsignedBigInteger('supermercado_id')->nullable();
            $table->foreign('supermercado_id')->references('id')->on('supermercados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sucursal_id']);
            $table->dropColumn('sucursal_id');
            $table->dropForeign(['supermercado_id']);
            $table->dropColumn('supermercado_id');
        });
    }
}
