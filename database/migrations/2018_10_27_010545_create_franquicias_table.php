<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranquiciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franquicias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('franquicia', 100)->unique();
            $table->text('resumen')->nullable();
            $table->string('logo', 200);
            $table->text('nosotros')->nullable();
            $table->text('historia')->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->string('cuota_inicial', 100)->nullable();
            $table->string('adaptacion_local', 100)->nullable();
            $table->string('regalias', 100)->nullable();
            $table->string('publicidad', 100)->nullable();
            $table->string('publicidad_institucional', 100)->nullable();
            $table->string('capital_trabajo', 100)->nullable();
            $table->string('inversion', 100)->nullable();
            $table->string('retorno_inversion', 100)->nullable();
            $table->string('punto_equilibrio', 100)->nullable();
            $table->string('utilidad', 100)->nullable();
            $table->string('contrato', 100)->nullable();
            $table->string('inicio_operaciones', 4)->nullable();
            $table->string('procedencia', 100)->nullable();
            $table->boolean('estatus')->default(1);
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('franquicia_categorias');
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
        Schema::dropIfExists('franquicias');
    }
}
