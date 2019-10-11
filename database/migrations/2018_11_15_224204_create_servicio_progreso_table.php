<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioProgresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_progreso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resultado')->default(0);
            $table->boolean('estatus')->default(0);
            $table->integer('orden')->default(1);
            $table->boolean('libera_venta')->default(0);
            $table->boolean('libera_operativa')->default(0);
            $table->boolean('libera_gestion')->default(0);
            $table->boolean('registro')->default(0);
            $table->integer('id_requisitos')->unsigned()->nullable();
            $table->foreign('id_requisitos')->references('id')->on('requisitos');
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->integer('id_admin')->unsigned()->nullable();
            $table->foreign('id_admin')->references('id')->on('users');
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
        Schema::dropIfExists('servicio_progreso');
    }
}
