<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_comision')->nullable();
            $table->date('fecha_aplicada')->nullable();
            $table->date('fecha_pagado')->nullable();
            $table->string('concepto', 25)->nullable();
            $table->string('tipo_comision', 25)->nullable();
            $table->string('comentarios', 256)->nullable();
            $table->decimal('monto', 18,2);
            $table->decimal('porcentaje_comision', 10,2)->default(0);
            $table->boolean('listo_comision')->default(0);
            $table->boolean('preseleccionar_comision')->default(0);
            $table->boolean('comision_aplicada')->default(0);
            $table->boolean('modificada')->default(0);
            $table->string('estatus', 20);
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users'); 
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->foreign('id_servicio')->references('id')->on('servicios'); 
            $table->integer('id_egresos')->unsigned()->nullable();
            $table->foreign('id_egresos')->references('id')->on('estados_cuenta'); 
            $table->integer('id_factura_detalle')->unsigned()->nullable();
            $table->foreign('id_factura_detalle')->references('id')->on('facturas_detalles'); 
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
        Schema::dropIfExists('nomina');
    }
}
