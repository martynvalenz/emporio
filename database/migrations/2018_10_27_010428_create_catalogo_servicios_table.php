<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogoServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave', 30)->unique();
            $table->string('servicio', 512);
            $table->string('comentarios', 512)->nullable();
            $table->enum('concepto', ['Neto', 'Porcentaje', 'por Proyecto'])->nullable();
            $table->string('moneda', 20);
            $table->decimal('costo', 18,2);
            $table->decimal('costo_servicio', 18,2)->default(0);
            $table->decimal('honorarios', 18,2)->default(0);
            $table->decimal('utilidad', 18,2)->default(0);
            $table->decimal('porcentaje_utilidad', 18,2)->default(0);
            /*$table->decimal('iva', 18,2);
            $table->decimal('total', 18,2);*/
            $table->enum('comision_venta', ['Monto Fijo', 'Porcentaje', 'Porcentaje Utilidad', 'Dolares', ''])->nullable();
            $table->decimal('comision_venta_monto', 18,2)->nullable()->default(0);
            $table->decimal('porcentaje_venta', 18,2)->nullable()->default(0);
            $table->enum('comision_operativa', ['Monto Fijo', 'Porcentaje', 'Porcentaje Utilidad', 'Dolares', ''])->nullable();
            $table->decimal('comision_operativa_monto', 18,2)->nullable()->default(0);
            $table->decimal('porcentaje_operativa', 18,2)->nullable()->default(0);
            $table->enum('comision_gestion', ['Monto Fijo', 'Porcentaje', 'Porcentaje Utilidad', 'Dolares', ''])->nullable();
            $table->decimal('comision_gestion_monto', 18,2)->nullable()->default(0);
            $table->decimal('porcentaje_gestion', 18,2)->nullable()->default(0);
            $table->integer('avance_total')->default(0);
            $table->text('procedimiento')->nullable();
            $table->string('diagrama', 256)->nullable();
            $table->boolean('estatus')->default(1);
            
            $table->timestamps();
            $table->integer('id_categoria_servicios')->unsigned()->nullable();
            $table->foreign('id_categoria_servicios')->references('id')->on('categoria_servicios');
            //$table->integer('id_subcategoria')->unsigned()->nullable();
            //$table->foreign('id_subcategoria')->references('id')->on('subcategoria_servicios');
            $table->integer('id_categoria_bitacora')->unsigned()->nullable();
            $table->foreign('id_categoria_bitacora')->references('id')->on('categoria_bitacoras');
            $table->integer('id_categoria_estatus')->unsigned()->nullable();
            $table->foreign('id_categoria_estatus')->references('id')->on('categoria_estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_servicios');
    }
}
