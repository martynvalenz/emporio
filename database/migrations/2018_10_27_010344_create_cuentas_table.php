<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 30)->unique();
            $table->string('tipo', 20);
            $table->string('cuenta', 20)->nullable();
            $table->string('clabe', 25)->nullable();
            $table->string('tarjeta', 20)->nullable();
            $table->decimal('saldo_inicial', 18,2)->default(0);
            $table->decimal('saldo', 18,2)->default(0);
            $table->string('comentarios', 128)->nullable();
            $table->boolean('estatus');
            $table->timestamps();
            $table->integer('id_banco')->unsigned()->nullable();
            $table->foreign('id_banco')->references('id')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
