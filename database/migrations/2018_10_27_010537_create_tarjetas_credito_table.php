<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarjetasCreditoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas_credito', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['Hogar', 'Personal', 'Despacho'])->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('con_iva')->default(0);
            $table->decimal('subtotal', 18,2)->default(0);
            $table->decimal('porcentaje_iva', 18,2)->default(0);
            $table->decimal('iva', 18,2)->default(0);
            $table->decimal('total', 18,2)->default(0);
            $table->decimal('pagado', 18,2)->default(0);
            $table->decimal('saldo', 18,2)->default(0);
            $table->enum('estatus', ['Pendiente', 'Cancelado', 'Pagado'])->default('Pendiente');
            $table->boolean('pagado_boolean')->default(0);
            $table->text('concepto')->nullable();
            $table->integer('id_proveedor')->unsigned()->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_egresos');
            $table->integer('id_cuenta')->unsigned()->nullable();
            $table->foreign('id_cuenta')->references('id')->on('cuentas');
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
        Schema::dropIfExists('tarjetas_credito');
    }
}
