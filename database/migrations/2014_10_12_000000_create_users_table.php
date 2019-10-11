<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iniciales', 5)->unique();
            $table->string('nombre', 50)->nullable();
            $table->string('apellido', 50)->nullable();
            $table->enum('area', ['Jurídico', 'Administración', 'Gestión', 'Dirección', 'Operaciones'])->nullable();
            $table->string('usuario', 50)->unique()->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('contra')->nullable();
            $table->string('rfc', 15)->nullable(); 
            $table->string('imss', 15)->nullable();
            $table->string('calle', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('numero_int', 20)->nullable();
            $table->string('colonia', 50)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('telefono', 30)->nullable();
            $table->string('celular', 30)->nullable();
            $table->string('oficina', 30)->nullable();
            $table->text('comentarios')->nullable();
            $table->string('imagen', 256)->nullable();
            $table->boolean('estatus')->default();
            $table->boolean('acepta_comision')->nullable()->default(0);
            $table->boolean('responsabilidad')->nullable()->default(0);
            $table->boolean('nomina')->nullable()->default(0);
            $table->decimal('sueldo_diario', 18,2)->nullable()->default(0);
            $table->decimal('sueldo_quincenal', 18,2)->nullable()->default(0);
            $table->timestamps();
            $table->rememberToken();
            $table->integer('id_estado')->unsigned()->nullable();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->integer('id_pais')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('paises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
