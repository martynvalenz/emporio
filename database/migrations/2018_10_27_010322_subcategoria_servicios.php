<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubcategoriaServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoria_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subcategoria');
            $table->boolean('estatus')->default(1);
            $table->boolean('renovacion')->default(1);
            $table->decimal('vencimiento', 10,2)->default(0);
            $table->decimal('recordatorio', 10,2)->default(0);
            $table->decimal('comprobacion_uso', 10, 2)->default(0);
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_estatus');
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
        Schema::dropIfExists('subcategoria_servicios');
    }
}
