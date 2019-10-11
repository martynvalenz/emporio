<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MetasDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor', 18,2)->default(0);
            $table->integer('id_anio')->unsigned()->nullable();
            $table->foreign('id_anio')->references('id')->on('metas');
            $table->integer('id_meta')->unsigned()->nullable();
            $table->foreign('id_meta')->references('id')->on('metas_plantilla');
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
        Schema::dropIfExists('metas_detalles');
    }
}
