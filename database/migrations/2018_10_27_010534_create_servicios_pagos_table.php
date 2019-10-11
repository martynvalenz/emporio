<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto', 18,2)->default(0);
            $table->integer('id_servicio')->unsigned();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->integer('id_egreso')->unsigned();
            $table->foreign('id_egreso')->references('id')->on('estados_cuenta');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users'); 
            $table->integer('id_control')->unsigned()->nullable();
            $table->foreign('id_control')->references('id')->on('control'); 
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
        Schema::dropIfExists('servicios_pagos');
    }
}
