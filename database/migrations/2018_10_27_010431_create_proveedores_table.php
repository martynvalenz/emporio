<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_comercial', 100)->unique();
            $table->string('razon_social', 100)->nullable();
            $table->string('rfc', 15)->nullable();
            $table->string('calle', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('numero_int', 20)->nullable();
            $table->string('colonia', 50)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('contacto', 50)->nullable();
            $table->string('telefono', 25)->nullable();
            $table->string('telefono2', 25)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('comentarios', 512)->nullable();
            $table->boolean('estatus');
            $table->boolean('realiza_pagos')->default(0);
            $table->timestamps();
            $table->integer('id_estado')->unsigned()->nullable();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->integer('id_pais')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('paises');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
