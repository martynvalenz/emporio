<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_cuenta', function (Blueprint $table) {
            $table->increments('id');
            //$table->enum('tipo', ['Ingreso', 'Egreso', 'Traspaso', 'Inversion', 'Nomina', 'Comision', 'Hogar', 'Personal']);
            $table->string('tipo', 50)->nullable();
            $table->enum('tipo_movimiento', ['INGRESO', 'EGRESO'])->nullable();
            $table->integer('orden')->default('1');
            $table->text('concepto')->nullable();
            $table->date('fecha_ini')->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('con_iva')->default(0);
            $table->string('folio', 50)->nullable();
            $table->string('cheque', 50)->nullable();
            $table->string('movimiento', 50)->nullable();
            $table->decimal('subtotal', 18,2)->default(0);
            $table->decimal('porcentaje_iva', 18,2)->default(0);
            $table->decimal('iva', 18,2)->default(0);
            $table->decimal('total', 18,2)->default(0);
            $table->decimal('deposito', 18,2)->nullable()->default(0);
            $table->decimal('retiro', 18,2)->nullable()->default(0);
            $table->decimal('pagado', 18,2)->nullable()->default(0);
            $table->decimal('restante', 18,2)->nullable()->default(0);
            $table->string('estatus', 20);
            $table->boolean('historico')->default(0);
            $table->boolean('revision')->default(0);
            $table->integer('id_comisionado')->unsigned()->nullable();
            $table->timestamps();
            $table->dateTime('cancelado_at')->nullable();
            $table->boolean('pagado_boolean')->nullable()->default(0);
            $table->boolean('cerrado_boolean')->nullable()->default(0);
            $table->boolean('pago_servicios')->nullable()->default(0);
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_egresos');
            $table->integer('id_forma_pago')->unsigned()->nullable();
            $table->foreign('id_forma_pago')->references('id')->on('formas_pago');
            $table->integer('id_cuenta_traspaso')->unsigned()->nullable();
            $table->integer('id_cuenta_egreso')->unsigned()->nullable();
            $table->integer('id_cuenta')->unsigned()->nullable();
            $table->foreign('id_cuenta')->references('id')->on('cuentas');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('id_servicio')->unsigned()->nullable();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->integer('id_razon_social')->unsigned()->nullable();
            $table->foreign('id_razon_social')->references('id')->on('razones_sociales');
            $table->integer('id_proveedor')->unsigned()->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_cuenta');
    }
}
