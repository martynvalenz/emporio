<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Estados;

class EstadosTableSeeder extends Seeder
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
                'estado' => 'Aguascalientes',
    			'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'estado' => 'Baja California',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'estado' => 'Baja California Sur',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],

    		[
    			'estado' => 'Campeche',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Chiapas',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Chihuahua',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Ciudad de México',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Coahuila',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Colima',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Durango',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Estado de México',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Guanajuato',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Guerrero',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Hidalgo',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Jalisco',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Michoacán',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Morelos',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Nayarit',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Nuevo León',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Oaxaca',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Puebla',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Querétaro',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Quintana Roo',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'San Luis Potosí',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Sinaloa',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Sonora',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Tabasco',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Tamaulipas',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Tlaxcala',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Veracruz',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Yucatán',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'estado' => 'Zacatecas',
                'id_pais' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
    	);

    	Estados::insert($data);
    }
}
