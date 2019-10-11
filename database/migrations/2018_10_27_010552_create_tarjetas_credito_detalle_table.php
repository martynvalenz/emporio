<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarjetasCreditoDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas_credito_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('subtotal', 18,2);
            $table->decimal('iva', 18,2);
            $table->decimal('total', 18,2);
            $table->date('fecha');
            $table->boolean('pagado')->default(0);
            $table->integer('id_egreso')->unsigned()->nullable();
            $table->foreign('id_egreso')->references('id')->on('estados_cuenta');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
            $table->integer('id_tarjeta')->unsigned();
            $table->foreign('id_tarjeta')->references('id')->on('tarjetas_credito');
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
        Schema::dropIfExists('tarjetas_credito_detalle');
    }
}
