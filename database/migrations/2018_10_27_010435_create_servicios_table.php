
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('tramite', 150)->nullable()->default();
            $table->date('fecha')->nullable();
            $table->string('concepto_costo', 20)->nullable();
            $table->string('moneda', 50)->nullable();
            $table->decimal('costo_servicio', 18,2)->nullable()->default(0);
            $table->boolean('asignar_costo_servicio')->default(0);
            $table->boolean('gestionar_pago')->default(0);
            $table->boolean('costo_pagado')->default(0);
            $table->decimal('costo_ini', 18,2)->nullable()->default(0);
            $table->decimal('tipo_cambio', 18,2)->nullable()->default(0);
            $table->decimal('descuento', 18,2)->nullable()->default(0);
            $table->decimal('porcentaje_descuento', 10,2)->nullable()->default(0);
            $table->decimal('costo', 18,2)->nullable()->default(0);
            $table->decimal('facturado', 18,2)->nullable()->default(0);
            $table->boolean('facturado_terminado')->default(0);
            $table->decimal('cobrado', 18)->nullable()->default(0);
            $table->boolean('cobrado_terminado')->default(0);
            $table->decimal('saldo', 18,2)->nullable()->default(0);
            /* Comisión */
            $table->string('concepto_venta',25)->nullable();
            $table->string('concepto_operativo', 25)->nullable();
            $table->string('concepto_gestion', 25)->nullable();
            $table->decimal('comision_venta', 18,2)->default(0);
            $table->decimal('porcentaje_comision_venta', 10,2)->default(0);
            $table->decimal('comision_operativa', 18,2)->default(0);
            $table->decimal('porcentaje_comision_operativa', 10,2)->default(0);
            $table->decimal('comision_gestion', 18,2)->default(0);
            $table->decimal('porcentaje_comision_gestion', 10,2)->default(0);
            $table->decimal('comision_venta_restante', 18,2)->default(0);
            $table->decimal('comision_operativa_restante', 18,2)->default(0);
            $table->decimal('comision_gestion_restante', 18,2)->default(0);
            $table->boolean('aplica_comision_venta')->default(0);
            $table->boolean('aplica_comision_operativa')->default(0);
            $table->boolean('aplica_comision_gestion')->default(0);
            $table->boolean('listo_comision_venta')->default(0);
            $table->boolean('listo_comision_operativa')->default(0);
            $table->boolean('listo_comision_gestion')->default(0);
            $table->date('fecha_comision_venta')->nullable();
            $table->date('fecha_comision_operativa')->nullable();
            $table->date('fecha_comision_gestion')->nullable();

            //Datos
            $table->boolean('mostrar_bitacora')->default(0);
            $table->integer('avance')->default(0);
            $table->integer('avance_total')->default(0);
            $table->string('logo_url', 300)->nullable();
            $table->enum('estatus_registro', ['Pendiente', 'Terminado', 'Cancelado', 'No Registro'])->nullable();
            $table->enum('estatus_cobranza', ['Pendiente', 'Pagado', 'Cancelado'])->nullable();

            //Fechas
            /*$table->boolean('renovacion')->default(1);
            $table->integer('vencimiento')->default(0);
            $table->integer('comprobacion_uso')->default(0);
            $table->enum('plazo_vencimiento', ['Dia', 'Anio', 'Mes'])->nullable();*/
            $table->date('fecha_pagado')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_cobranza')->nullable();
            $table->date('fecha_declaracion')->nullable();
            $table->date('fecha_recordatorio')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('historico')->default(0);
            
            $table->timestamps();
            /* Llaves foráenas */
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('id_razon_social')->unsigned()->nullable();
            $table->foreign('id_razon_social')->references('id')->on('razones_sociales');
            $table->integer('id_control')->unsigned()->nullable();
            $table->foreign('id_control')->references('id')->on('control');
            $table->integer('id_catalogo_servicio')->unsigned()->nullable();
            $table->foreign('id_catalogo_servicio')->references('id')->on('catalogo_servicios');
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_servicios');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
            $table->integer('id_bitacoras')->unsigned()->nullable();
            $table->foreign('id_bitacoras')->references('id')->on('categoria_bitacoras');
            $table->integer('id_clase')->unsigned()->nullable();
            $table->foreign('id_clase')->references('id')->on('clases');
            $table->integer('id_estatus')->unsigned()->nullable();
            $table->foreign('id_estatus')->references('id')->on('bitacoras_estatus');
            $table->integer('id_egreso')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
