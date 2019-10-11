<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListadoEstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listado_estatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estatus', 30);
            $table->boolean('activo')->default(1);
            $table->string('color', 10);
            $table->string('texto', 10);
            $table->timestamps();
            $table->integer('id_bitacoras_estatus')->unsigned()->nullable();
            $table->foreign('id_bitacoras_estatus')->references('id')->on('categoria_estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listado_estatus');
    }
}
