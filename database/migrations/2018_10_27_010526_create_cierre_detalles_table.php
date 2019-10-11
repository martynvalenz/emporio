<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierreDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('saldo_inicial', 20,2);
            $table->decimal('ingresos', 20,2);
            $table->decimal('egresos', 20,2);
            $table->decimal('saldo_final', 20,2);
            $table->decimal('saldo_real', 20,2);
            $table->integer('id_cierre')->unsigned();
            $table->foreign('id_cierre')->references('id')->on('cierre_mensual');
            $table->integer('id_cuenta')->unsigned();
            $table->foreign('id_cuenta')->references('id')->on('cuentas');
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
        Schema::dropIfExists('cierre_detalles');
    }
}
