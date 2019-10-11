<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroFranquiciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_franquicias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('correo', 50);
            $table->string('telefono', 50);
            $table->boolean('leido')->default(0);
            $table->text('mensaje')->nullable();
            $table->integer('id_franquicia')->unsigned()->nullable();
            $table->foreign('id_franquicia')->references('id')->on('franquicias');
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
        Schema::dropIfExists('registro_franquicias');
    }
}
