<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Estrategias;

class EstrategiasTableSeeder extends Seeder
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
                'estrategia' => 'Prospección',
                'estatus' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'estrategia' => 'Referido',
                'estatus' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'estrategia' => 'Página web',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estrategia' => 'Facebook',
                'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
            [
                'estrategia' => 'BNI',
                'estatus' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'estrategia' => 'AMF',
                'estatus' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ]
        );

        Estrategias::insert($data);
    }
}
