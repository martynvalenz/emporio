<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\FranquiciaCategorias;

class FranquiciaCategoriaTableSeeder extends Seeder
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
            	'id' => '1',
                'categoria' => 'Agencia de viajes',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '2',
                'categoria' => 'Barbería',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '3',
                'categoria' => 'Belleza',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '4',
                'categoria' => 'Boutique',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '5',
                'categoria' => 'Comercializadora',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '6',
                'categoria' => 'Gimnasio',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '7',
                'categoria' => 'Nevería',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '8',
                'categoria' => 'Organización de eventos',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '9',
                'categoria' => 'Pastelería',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '10',
                'categoria' => 'Recreativo',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '11',
                'categoria' => 'Restaurante',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '12',
                'categoria' => 'Revista',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'id' => '13',
                'categoria' => 'Servicios',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
        );

        FranquiciaCategorias::insert($data);
    }
}
