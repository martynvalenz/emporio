<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['Factura', 'Recibo']);
            $table->string('folio_factura', 20)->nullable()->default('');
            $table->string('folio_recibo', 20)->nullable()->default('');
            $table->string('folio_fiscal', 100)->nullable()->default();
            $table->string('razon_social', 100)->nullable()->default();
            $table->date('fecha');
            $table->string('rfc', 15)->nullable();
            $table->string('calle', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('numero_int', 20)->nullable();
            $table->string('colonia', 50)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('pais', 50)->nullable();
            $table->timestamps();
            $table->date('fecha_compromiso')->nullable();
            $table->date('fecha_pagada')->nullable();
            $table->decimal('subtotal', 18,2);
            $table->decimal('porcentaje_iva', 18,2);
            $table->decimal('iva', 18,2);
            $table->boolean('con_iva')->default(0);
            $table->decimal('total', 18,2);
            $table->decimal('pagado', 18,2)->default(0);
            $table->boolean('pagado_terminado')->default(0);
            $table->decimal('saldo', 18,2);
            $table->decimal('cancelado', 18,2)->default(0);
            $table->string('estatus', 30);
            $table->boolean('historico')->default(0);
            $table->text('comentarios')->nullable();

            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('id_razon_social')->unsigned()->nullable();
            $table->foreign('id_razon_social')->references('id')->on('razones_sociales');
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
        Schema::dropIfExists('facturas');
    }
}
