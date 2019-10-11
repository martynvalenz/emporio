<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_egresos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('clasificacion', ['Despacho', 'Personal', 'Hogar']);
            $table->string('cuenta', 50)->nullable();
            $table->string('subcuenta', 50)->nullable();
            $table->string('categoria', 50);
            $table->string('descripcion', 256)->nullable();
            $table->boolean('estatus')->default(1);
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
        Schema::dropIfExists('categoria_egresos');
    }
}
