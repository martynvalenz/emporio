<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Emporio;

class EmporioTableSeeder extends Seeder
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
    			'nombre_comercial' => 'Emporio Legal',
    			'razon_social' => 'Allan José Parra Vargas',
    			'rfc' => 'PAVA8003211H5',
    			'calle' => 'Mariano Irigoyen',
    			'numero' => '1301',
    			'numero_int' => 'Altos',
    			'colonia' => 'Obrera',
    			'cp' => '31350',
    			'localidad' => 'Chihuahua',
    			'municipio' => 'Chihuahua',
    			'estado' => 'Chihuahua',
    			'pais' => 'México',
    			'logo' => '',
    			'telefono' => '6144102482',
    			'telefono2' => '6142014229',
    			'telefono3' => '6142971837',
    			'pagina_web' => 'http://marcasyfranquicias.org',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
    	);

    	Emporio::insert($data);
    }
}
