<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Monedas;

class MonedasTableSeeder extends Seeder
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
        			'clave' => 'MXN',
                    'moneda' => 'Pesos',
        			'pais' => 'México',
        			'conversion' => '1',
        			'estatus' => '1',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'clave' => 'USD',
                    'moneda' => 'Dólares',
        			'pais' => 'Estados Unidos',
        			'conversion' => '20',
        			'estatus' => '1',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        	);

        	Monedas::insert($data);
    }
}
