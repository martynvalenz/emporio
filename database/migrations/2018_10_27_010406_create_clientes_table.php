<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_comercial', 100)->unique();
            $table->string('logo', 300)->default('cliente.png');
            $table->string('pagina_web', 100)->nullable();
            $table->string('carpeta', 300)->nullable();
            $table->string('comentarios', 512)->nullable();
            $table->boolean('estatus');
            $table->decimal('saldo', 18, 2)->default(0);
            $table->timestamps();   
            $table->integer('id_estrategia')->unsigned()->nullable();
            $table->foreign('id_estrategia')->references('id')->on('estrategias');
            $table->integer('id_admin')->unsigned()->nullable();
            $table->foreign('id_admin')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
