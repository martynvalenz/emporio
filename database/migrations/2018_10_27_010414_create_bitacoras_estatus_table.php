<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasEstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras_estatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio_estatus', 50)->nullable();
            $table->string('numero_expediente', 50)->nullable();
            $table->string('numero_registro', 50)->nullable();
            $table->string('registro_url', 300)->nullable();
            $table->string('numero_tramite', 50)->nullable();
            $table->string('patente', 50)->nullable();
            $table->string('marca', 100)->nullable();
            //$table->string('nombre', 100)->nullable();
            $table->string('pc', 50)->nullable();
            $table->string('estatus_status', 50)->nullable();
            $table->string('tipo_tramite', 50)->nullable();
            $table->string('carpeta', 50)->nullable();
            $table->string('carpeta_url', 300)->nullable();
            $table->string('codigo_barras', 50)->nullable();
            $table->string('representante', 100)->nullable();
            //$table->boolean('comprobacion_uso')->default(0);
            $table->integer('comprobacion')->default(0);
            $table->integer('vencimiento')->default(0);
            $table->integer('recordatorio')->default(0);
            $table->boolean('renovacion')->default(1);
            $table->boolean('comprobacion_uso')->default(0);
            $table->enum('plazo', ['Dias', 'Años', 'Meses'])->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_recordatorio')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->date('fecha_anualidad')->nullable();
            $table->date('fecha_comprobacion_uso')->nullable();
            $table->date('fecha_entrega_certificado')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('comentarios')->nullable();
            $table->boolean('vigencia')->default(1);

            //Llaves foráneas
            $table->integer('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->integer('id_razon_social')->unsigned()->nullable();
            $table->foreign('id_razon_social')->references('id')->on('razones_sociales');
            $table->integer('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('users');
            $table->integer('id_bitacoras_estatus')->unsigned()->nullable();
            $table->foreign('id_bitacoras_estatus')->references('id')->on('categoria_estatus');
            $table->integer('id_estatus')->unsigned()->nullable();
            $table->foreign('id_estatus')->references('id')->on('listado_estatus');
            $table->integer('id_clase')->unsigned()->nullable();
            $table->foreign('id_clase')->references('id')->on('clases');
            $table->integer('id_marca')->unsigned()->nullable();
            $table->foreign('id_marca')->references('id')->on('control');
            $table->integer('id_categoria')->unsigned()->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_servicios');
            $table->integer('id_subcategoria')->unsigned()->nullable();
            $table->foreign('id_subcategoria')->references('id')->on('subcategoria_servicios');
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
        Schema::dropIfExists('bitacoras_estatus');
    }
}
