<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\PorcentajeIVA;

class PorcentajeIVATableSeeder extends Seeder
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
                'porcentaje_iva' => '16.00',
                'created_at' => new DateTime,
        		'updated_at' => new DateTime
            ],

            
    	);

    	PorcentajeIVA::insert($data);
    }
}
