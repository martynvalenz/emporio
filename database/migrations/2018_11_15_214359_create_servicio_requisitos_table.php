<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_requisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orden')->default(1);
            $table->boolean('libera_venta')->default(0);
            $table->boolean('libera_operativa')->default(0);
            $table->boolean('libera_gestion')->default(0);
            $table->boolean('registro')->default(0);
            $table->integer('id_requisitos')->unsigned()->nullable();
            $table->foreign('id_requisitos')->references('id')->on('requisitos');
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
        Schema::dropIfExists('servicio_requisitos');
    }
}
