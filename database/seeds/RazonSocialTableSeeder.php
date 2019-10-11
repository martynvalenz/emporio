<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\RazonSocial;

class RazonSocialTableSeeder extends Seeder
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
    			'razon_social' => 'ALLAN JOSE PARRA VARGAS',
    			'rfc' => 'PAVA8003211H5',
    			'calle' => 'Mariano Irigoyen',
    			'numero' => '1301',
    			'numero_int' => 'Altos',
    			'colonia' => 'Obrera',
    			'cp' => '31350',
    			'localidad' => 'Chihuahua',
    			'municipio' => 'Chihuahua',
    			'id_estado' => '6',
    			'id_pais' => '1',
    			'telefono' => '6144102482',
    			'correo' => 'administracion@marcasyfranquicias.org',
                'id_admin' => '1',
                'id_cliente' => '1',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
    	);

    	RazonSocial::insert($data);
    }
}
