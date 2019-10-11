<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierreMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre_mensual', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes', 25)->nullable();
            $table->string('trimestre', 1)->nullable();
            $table->string('anio', 4);
            $table->enum('periodo', ['Mensual', 'Trimestral', 'Anual']);
            $table->decimal('saldo_inicial', 20,2);
            $table->decimal('ingresos', 20,2);
            $table->decimal('egresos', 20,2);
            $table->decimal('saldo_final', 20,2);
            $table->enum('estatus', ['Abierto', 'Cerrado', 'Cancelado'])->default('Abierto');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
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
        Schema::dropIfExists('cierre_mensual');
    }
}
