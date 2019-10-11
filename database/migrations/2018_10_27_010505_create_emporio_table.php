<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmporioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emporio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_comercial', 50);
            $table->string('razon_social', 100);
            $table->string('rfc', 15)->nullable()->unique();
            $table->string('calle', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('numero_int', 20)->nullable();
            $table->string('colonia', 50)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('pais', 50)->nullable();
            $table->string('logo', 300)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('telefono2', 20)->nullable();
            $table->string('telefono3', 20)->nullable();
            $table->string('pagina_web', 100)->nullable();
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
        Schema::dropIfExists('emporio');
    }
}
