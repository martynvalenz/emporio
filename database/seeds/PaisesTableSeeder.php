<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Paises;

class PaisesTableSeeder extends Seeder
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
        			'pais' => 'México',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
        			'pais' => 'Estados Unidos',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		]
        	);

        	Paises::insert($data);
    }
}
