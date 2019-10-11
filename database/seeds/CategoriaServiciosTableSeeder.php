<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CategoriaServicios;

class CategoriaServiciosTableSeeder extends Seeder
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
            	'categoria' => 'Código de Barras y Servicios de Diseño',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
            	'id' => 2,
                'categoria' => 'Registro de Obras',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 3,
            	'categoria' => 'Franquicias',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 4,
            	'categoria' => 'Invenciones',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 5,
            	'categoria' => 'Servicios Jurídicos',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 6,
            	'categoria' => 'Signos Distintivos',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 7,
            	'categoria' => 'Reserva de Derechos',
            	'descripcion' => '',
            	'created_at' => new DateTime,
            	'updated_at' => new DateTime
            ],
            [
                'id' => 8,
                'categoria' => 'Otros',
                'descripcion' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        );
        
        CategoriaServicios::insert($data);
    }
}
