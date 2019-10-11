<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobranzaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobranza_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cobranza')->unsigned();
            $table->foreign('id_cobranza')->references('id')->on('estados_cuenta');
            $table->integer('id_factura')->unsigned();
            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->decimal('monto', 18,2);
            $table->boolean('pagado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobranza_detalles');
    }
}
