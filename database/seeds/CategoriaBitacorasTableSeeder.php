<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CategoriaBitacoras;

class CategoriaBitacorasTableSeeder extends Seeder
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
                    'id' => 1,
        			'clave' => 'TN',
        			'bitacora' => 'Trámites Nuevos',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => 2,
        			'clave' => 'FACT',
        			'bitacora' => 'Estudios de Factibilidad',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => 3,
        			'clave' => 'NEG',
        			'bitacora' => 'Negativas',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => 4,
        			'clave' => 'TIT',
        			'bitacora' => 'Títulos y Certificados',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => 5,
        			'clave' => 'REQ',
        			'bitacora' => 'Requisitos y Objeciones',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
                [
                    'id' => 6,
                    'clave' => 'OT',
                    'bitacora' => 'Otros',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
        	);

        	CategoriaBitacoras::insert($data);
    }
}
