<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comentario');
            $table->timestamps();
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->integer('id_admin')->unsigned()->nullable();
            $table->foreign('id_admin')->references('id')->on('users'); 
            $table->integer('id_estatus')->unsigned()->nullable();
            $table->foreign('id_estatus')->references('id')->on('bitacoras_estatus'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios_comentarios');
    }
}
