<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\FormasPago;

class FormasPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array
    	(
    		[
    			'codigo' => '01',
    			'forma_pago' => 'Efectivo',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '02',
    			'forma_pago' => 'Cheque nominativo',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '03',
    			'forma_pago' => 'Transferencia electrónica de fondos',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '04',
    			'forma_pago' => 'Tarjeta de crédito',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '05',
    			'forma_pago' => 'Monedero eletrónico',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '06',
    			'forma_pago' => 'Dinero electrónico',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '08',
    			'forma_pago' => 'Vales de despensa',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

            [
                'codigo' => '12',
                'forma_pago' => 'Dación de pago',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '13',
                'forma_pago' => 'Pago por subrogación',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '14',
                'forma_pago' => 'Pago por consignación',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '15',
                'forma_pago' => 'Condonación',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '17',
                'forma_pago' => 'Compensación',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '23',
                'forma_pago' => 'Novación',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '24',
                'forma_pago' => 'Confusión',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '25',
                'forma_pago' => 'Remisión de deuda',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '26',
                'forma_pago' => 'Prescripción o caducidad',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

            [
                'codigo' => '27',
                'forma_pago' => 'A satisfacción del acreedor',
                'descripcion' => '',
                'estatus' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],

    		[
    			'codigo' => '28',
    			'forma_pago' => 'Tarjeta de débido',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '29',
    			'forma_pago' => 'Tarjeta de servicio',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'codigo' => '99',
    			'forma_pago' => 'Por definir',
    			'descripcion' => '',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
        );

        FormasPago::insert($data);
    }
}
