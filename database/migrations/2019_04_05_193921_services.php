<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('servicio', 120);
            $table->string('slug', 120);
            $table->text('descripcion')->nullable();
            $table->boolean('estatus')->default(1);
            $table->integer('id_category')->unsigned()->nullable();
            $table->foreign('id_category')->references('id')->on('category_services');
            $table->timestamps();
        });*/

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('initials', 5)->unique();
            $table->string('name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->enum('area', ['Jurídico', 'Administración', 'Gestión', 'Dirección', 'Operaciones'])->nullable();
            $table->string('username', 50)->unique()->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('contra')->nullable();
            $table->string('rfc', 15)->nullable(); 
            $table->string('imss', 15)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('number_int', 20)->nullable();
            $table->string('colony', 50)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('phone', 30)->nullable();}
            $table->string('office', 30)->nullable();
            $table->text('comments')->nullable();
            $table->string('avatar', 256)->nullable()->default('avatar.png');
            $table->boolean('comission')->nullable()->default(0);
            $table->boolean('responsability')->nullable()->default(0);
            $table->boolean('wage')->nullable()->default(0);
            $table->decimal('daily_salary', 18,2)->nullable()->default(0);
            $table->decimal('biweekly_salary', 18,2)->nullable()->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamps();
            $table->rememberToken();
            /*$table->integer('id_estado')->unsigned()->nullable();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->integer('id_pais')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('paises');*/
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10);
            $table->string('country', 50);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10);
            $table->string('state', 50);
            $table->boolean('status')->default(1);
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });

        Schema::create('permissions_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category', 50)->unique();
            $table->string('slug', 50)->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('binnacles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 15)->nullable();
            $table->string('binnacle', 50);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('status_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 15)->nullable();
            $table->string('binnacle_status', 50);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('status_subcategory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subcategory');
            $table->boolean('status')->default(1);
            $table->boolean('renovation')->default(1);
            $table->decimal('expiration', 10,2)->default(0);
            $table->decimal('reminder', 10,2)->default(0);
            $table->decimal('declaration_use', 10, 2)->default(0);
            $table->bigInteger('status_category_id')->unsigned()->nullable();
            $table->foreign('status_category_id')->references('id')->on('status_category');
            $table->timestamps();
        });

        Schema::create('services_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category', 50);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('status_subcategory_id')->unsigned()->nullable();
            $table->foreign('status_subcategory_id')->references('id')->on('status_subcategory');
            $table->timestamps();
        });

        Schema::create('money_exchange', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 10);
            $table->string('coin', 50);
            $table->decimal('conversion', 18,2);
            $table->boolean('status')->default(1);
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });

         Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave', 5);
            $table->string('bank', 50);
            $table->string('social_reason', 150);
            $table->string('status')->default(1);
            $table->timestamps();
        });

         Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alias', 30)->unique();
            $table->string('account', 20)->nullable();
            $table->string('clabe', 25)->nullable();
            $table->string('card', 20)->nullable();
            // $table->decimal('saldo_inicial', 18,2)->default(0);
            // $table->decimal('saldo', 18,2)->default(0);
            $table->string('comments', 128)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->timestamps();
        });

        Schema::create('expenses_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Despacho', 'Personal', 'Hogar']);
            $table->string('account', 50)->nullable();
            $table->string('subaccount', 50)->nullable();
            $table->string('category', 50);
            $table->string('description', 256)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('strategies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('strategy', 50);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('paying_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 3);
            $table->string('paying_method', 50);
            $table->string('description', 256)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 15)->unique();
            $table->string('class', 512);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer', 100)->unique();
            $table->string('logo', 300)->default('cliente.png');
            $table->string('web_page', 100)->nullable();
            $table->string('folder', 300)->nullable();
            $table->string('comments', 512)->nullable();
            $table->boolean('status')->default(1);
            $table->decimal('balance', 18, 2)->default(0);
            $table->bigInteger('referred_by')->unsigned()->nullable();
            $table->bigInteger('strategy_id')->unsigned()->nullable();
            $table->foreign('strategy_id')->references('id')->on('strategies');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('social_reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('social_reason', 190);
            $table->string('rfc', 50);
            $table->string('street', 100)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('number_int', 20)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('colony', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->timestamps();
            // $table->bigInteger('city_id')->unsigned()->nullable();
            // $table->foreign('city_id')->references('id')->on('cities');
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
        });

        Schema::create('status_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_color', 30);
            $table->boolean('status')->default(1);
            $table->string('color', 10);
            $table->string('text', 10);
            $table->timestamps();
            $table->bigInteger('status_category_id')->unsigned()->nullable();
            $table->foreign('status_category_id')->references('id')->on('status_category');
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand', 512);
            $table->text('description')->nullable();
            $table->string('logo_url', 300)->default('logo-marca.png')->nullable();
            $table->date('registration_date')->nullable();
            $table->boolean('registered')->default(0);
            $table->boolean('status')->default(1);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('position',30)->nullable();
            $table->string('title',30)->nullable();
            $table->string('area',30)->nullable();
            $table->string('name', 50);
            $table->string('email', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('extension', 6)->nullable();
            $table->text('comments')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('social_reason_id')->unsigned()->nullable();
            $table->foreign('social_reason_id')->references('id')->on('social_reasons');
            $table->timestamps();
        });

        Schema::create('services_catalog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30)->unique();
            $table->string('service', 512);
            $table->string('comments', 512)->nullable();
            $table->enum('concept', ['Neto', 'Porcentaje', 'por Proyecto'])->nullable();
            $table->decimal('price', 18,2);
            $table->decimal('cost', 18,2)->default(0);
            $table->decimal('fee', 18,2)->default(0);
            $table->decimal('utility', 18,2)->default(0);
            $table->decimal('utility_percent', 18,2)->default(0);
            $table->decimal('sales_comission', 18,2)->default(0);
            $table->decimal('management_comission', 18,2)->default(0);
            $table->decimal('operations_comission', 18,2)->default(0);
            $table->integer('total_advance')->default(0);
            $table->text('procedure')->nullable();
            $table->string('diagram', 256)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->bigInteger('money_exchange_id')->unsigned()->nullable();
            $table->foreign('money_exchange_id')->references('id')->on('money_exchange');
            $table->bigInteger('services_category_id')->unsigned()->nullable();
            $table->foreign('services_category_id')->references('id')->on('services_category');
            $table->bigInteger('binnacle_id')->unsigned()->nullable();
            $table->foreign('binnacle_id')->references('id')->on('binnacles');
            $table->bigInteger('status_category_id')->unsigned()->nullable();
            $table->foreign('status_category_id')->references('id')->on('status_category');
            $table->bigInteger('status_subcategory_id')->unsigned()->nullable();
            $table->foreign('status_subcategory_id')->references('id')->on('status_subcategory');
        });

        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider', 100)->unique();
            $table->boolean('status')->default(1);
            $table->boolean('service_payments')->default(0);
            $table->timestamps();
            $table->integer('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('account_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 50)->nullable();
            $table->integer('movement_type'); //0.Income 1.Expense 2.Exchange
            $table->integer('order')->default('1');
            $table->text('comment')->nullable();
            $table->date('date')->nullable();
            $table->date('date_promise')->nullable();
            $table->string('folio', 50)->nullable();
            $table->string('cheque', 50)->nullable();
            $table->string('movimiento', 50)->nullable();
            $table->decimal('subtotal', 18,2)->default(0);
            $table->decimal('tax_percent', 18,2)->default(0);
            $table->boolean('has_tax')->default(0);
            $table->decimal('tax', 18,2)->default(0);
            $table->decimal('total', 18,2)->default(0);
            $table->decimal('deposit', 18,2)->default(0);
            $table->decimal('withdraw', 18,2)->default(0);
            $table->integer('status')->default(0);//0.Pendient 1.Payed 2.Cancelled
            $table->boolean('historic')->default(0);
            $table->boolean('revision')->default(0);
            $table->bigInteger('comissioner_id')->unsigned()->nullable();
            $table->timestamps();
            $table->dateTime('cancelled_at')->nullable();
            $table->boolean('service_payment')->default(0);
            $table->bigInteger('expenses_category_id')->unsigned()->nullable();
            $table->foreign('expenses_category_id')->references('id')->on('expenses_category');
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->bigInteger('transfer_account_id')->unsigned()->nullable();
            $table->bigInteger('received_account_id')->unsigned()->nullable();
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('clientes');
            $table->bigInteger('service_control_id')->unsigned()->nullable();
            $table->foreign('service_control_id')->references('id')->on('services_control');
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('providers');
        });

        Schema::create('binnacle_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_folio', 50)->nullable();
            $table->string('case_file', 50)->nullable();
            $table->string('registry', 50)->nullable();
            $table->string('tramit_number', 50)->nullable();
            $table->string('patent', 50)->nullable();
            $table->string('pc', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('tramit_type', 50)->nullable();
            $table->string('folder', 50)->nullable();
            $table->string('folder_url', 300)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->integer('expiration')->default(0);
            $table->integer('reminder')->default(0);
            $table->boolean('renovation')->default(1);
            $table->boolean('declaration_use')->default(0);
            $table->enum('term', ['Dias', 'Años', 'Meses'])->nullable();
            $table->date('date')->nullable();
            $table->date('date_reminder')->nullable();
            $table->date('date_expiration')->nullable();
            $table->date('date_annuity')->nullable();
            $table->date('date_declaration')->nullable();
            $table->date('date_certificate')->nullable();
            $table->text('observations')->nullable();
            // $table->text('comentarios')->nullable();
            $table->boolean('validity')->default(1); //vigencia
            //Llaves foráneas
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('representative_id')->unsigned()->nullable();
            $table->foreign('representative_id')->references('id')->on('contacts');
            $table->bigInteger('social_reason_id')->unsigned()->nullable();
            $table->foreign('social_reason_id')->references('id')->on('social_reason');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('status_category_id')->unsigned()->nullable();
            $table->foreign('status_category_id')->references('id')->on('status_category');
            $table->bigInteger('status_subcategory_id')->unsigned()->nullable();
            $table->foreign('status_subcategory_id')->references('id')->on('status_subcategory');
            $table->bigInteger('status_color_id')->unsigned()->nullable();
            $table->foreign('status_color_id')->references('id')->on('status_colors');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->timestamps();
        });

        Schema::create('services_control', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('procedure', 150)->nullable()->default();
            $table->date('date')->nullable();
            $table->decimal('cost', 18,2)->nullable()->default(0);
            $table->boolean('asign_cost')->default(0);
            $table->boolean('manage_cost')->default(0);
            $table->boolean('payed_cost')->default(0);
            $table->decimal('price', 18,2)->default(0);
            $table->decimal('money_exchange', 18,2)->default(0);
            $table->decimal('discount', 18,2)->default(0);
            $table->decimal('discount_percent', 10,2)->default(0);
            $table->decimal('final_price', 18,2)->default(0);
            $table->decimal('billing', 18,2)->default(0);
            $table->boolean('billed')->default(0);
            $table->decimal('charged', 18)->default(0);
            $table->boolean('charged_finished')->default(0);
            $table->decimal('balance', 18,2)->default(0);
            /* Comisión */
            $table->decimal('sales_comission', 18,2)->default(0);
            $table->decimal('sales_comission_percent', 10,2)->default(0);
            $table->decimal('sales_comission_residue', 18,2)->default(0);
            $table->boolean('sales_comission_applied')->default(0);
            $table->decimal('operating_comission', 18,2)->default(0);
            $table->decimal('operating_comission_percent', 10,2)->default(0);
            $table->decimal('operating_comission_residue', 18,2)->default(0);
            $table->boolean('operating_comission_applied')->default(0);
            $table->decimal('management_comission', 18,2)->default(0);
            $table->decimal('management_comission_percent', 10,2)->default(0);
            $table->decimal('management_comission_residue', 18,2)->default(0);
            $table->boolean('management_comission_applied')->default(0);
            //Datos
            $table->boolean('show_binnacle')->default(0);
            $table->integer('advance')->default(0);
            $table->integer('advance_total')->default(0);
            $table->integer('status')->default(0); //0.Pendient 1.Finished 2.Canceled 3.No Registry
            $table->integer('is_payed')->default(0); //0.Pendient 1.Payed
            //Fechas
            $table->date('date_payed')->nullable();
            $table->date('date_registered')->nullable();
            $table->date('date_declaration')->nullable();
            $table->date('date_reminder')->nullable();
            $table->date('date_expiration')->nullable();
            $table->boolean('historical')->default(0);
            $table->timestamps();
            /* Llaves foráenas */
            $table->bigInteger('money_exchange_id')->unsigned()->nullable();
            $table->foreign('money_exchange_id')->references('id')->on('money_exchange');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('services_catalog_id')->unsigned()->nullable();
            $table->foreign('services_catalog_id')->references('id')->on('services_catalog');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('binnacle_id')->unsigned()->nullable();
            $table->foreign('binnacle_id')->references('id')->on('binnacles');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->bigInteger('binnacle_status_id')->unsigned()->nullable();
            $table->foreign('binnacle_status_id')->references('id')->on('binnacle_status');
            $table->bigInteger('account_statement_id')->unsigned()->nullable();
            $table->foreign('account_statement_id')->references('id')->on('account_statements');
        });

        Schema::create('billing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Factura', 'Recibo']);
            $table->string('folio_bill', 20)->nullable()->default('');
            $table->string('folio_receipt', 20)->nullable()->default('');
            $table->string('folio_fiscal', 100)->nullable()->default();
            $table->date('date');
            $table->timestamps();
            $table->date('date_commitment')->nullable();
            $table->date('date_payed')->nullable();
            $table->decimal('subtotal', 18,2);
            $table->decimal('tax_percent', 18,2);
            $table->decimal('tax', 18,2);
            $table->boolean('has_tax')->default(0);
            $table->decimal('total', 18,2);
            $table->decimal('payed_amount', 18,2)->default(0);
            $table->boolean('is_payed')->default(0);
            $table->decimal('balance', 18,2);
            $table->decimal('is_canceled', 18,2)->default(0);
            $table->boolean('status')->default(0);//0.Pendient 1.Payed 2.Cancelled
            $table->boolean('historic')->default(0);
            $table->text('comments')->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('social_reason_id')->unsigned()->nullable();
            $table->foreign('social_reason_id')->references('id')->on('social_reasons');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comentario');
            $table->timestamps();
            $table->integer('services_control_id')->unsigned()->nullable();
            $table->foreign('services_control_id')->references('id')->on('services_control');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->integer('binnacle_status_id')->unsigned()->nullable();
            $table->foreign('binnacle_status_id')->references('id')->on('binnacle_status'); 
        });

        Schema::create('emporio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emporio', 50);
            $table->string('social_reason', 100);
            $table->string('rfc', 50);
            $table->string('street', 100)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('number_int', 20)->nullable();
            $table->string('cp', 5)->nullable();
            $table->string('colony', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->timestamps();
            // $table->bigInteger('city_id')->unsigned()->nullable();
            // $table->foreign('city_id')->references('id')->on('cities');
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('logo', 300)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('phone3', 20)->nullable();
            $table->string('web_page', 100)->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
