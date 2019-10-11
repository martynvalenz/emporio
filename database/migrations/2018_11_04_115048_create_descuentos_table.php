<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('porcentaje_descuento', 10,2)->default(0);
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes'); 
            $table->integer('id_catalogo_servicio')->unsigned()->nullable();
            $table->foreign('id_catalogo_servicio')->references('id')->on('catalogo_servicios');
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
        Schema::dropIfExists('descuentos');
    }
}
