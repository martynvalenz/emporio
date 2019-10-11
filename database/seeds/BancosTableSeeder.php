<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Bancos;


class BancosTableSeeder extends Seeder
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
                    'banco' => 'Efectivo',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
        		[
        			'banco' => 'BBVA Bancomer',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'banco' => 'Banamex',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'banco' => 'Scotiabank',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'banco' => 'Santander',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'banco' => 'HSBC',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
                [
                    'banco' => 'Banorte',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ]
        	);

        	Bancos::insert($data);
    }
}
