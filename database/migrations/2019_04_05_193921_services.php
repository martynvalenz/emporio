<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('servicio', 120);
            $table->string('slug', 120);
            $table->text('descripcion')->nullable();
            $table->boolean('estatus')->default(1);
            $table->integer('id_category')->unsigned()->nullable();
            $table->foreign('id_category')->references('id')->on('category_services');
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
        Schema::dropIfExists('services');
    }
}
