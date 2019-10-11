<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('puesto',30)->nullable();
            $table->string('titulo',30)->nullable();
            $table->string('area',30)->nullable();
            $table->string('nombre', 50);
            $table->string('user', 50)->unique()->nullable();
            $table->string('email', 100)->nullable();
            $table->string('email2', 100)->nullable();
            $table->string('email3', 100)->nullable();
            $table->string('password')->nullable();
            $table->string('contra')->nullable();
            $table->string('tipo', 30)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('ext', 6)->nullable();
            $table->string('tipo2', 30)->nullable();
            $table->string('telefono2', 50)->nullable();
            $table->string('ext2', 6)->nullable();
            $table->string('tipo3', 30)->nullable();
            $table->string('telefono3', 50)->nullable();
            $table->string('ext3', 6)->nullable();
            $table->string('comentarios', 300)->nullable();
            $table->boolean('estatus')->default(1);
            $table->rememberToken();
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('id_razon_social')->unsigned()->nullable();
            $table->foreign('id_razon_social')->references('id')->on('razones_sociales');
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
        Schema::dropIfExists('clientes_users');
    }
}
