<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guia', 30);
            $table->string('destinatario', 50);
            $table->string('concepto', 100)->nullable();
            $table->date('fecha');
            $table->date('recibido')->nullable();
            $table->string('factura', 20)->nullable();
            $table->decimal('importe', 18,2)->nullable();
            $table->string('estatus', 20);
            $table->timestamps();
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guias');
    }
}
