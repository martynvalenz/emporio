<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;

class ClientesTableSeeder extends Seeder
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
    			'nombre_comercial' => 'EMPORIO LEGAL',
    			'logo' => 'emporio.png',
    			'pagina_web' => 'http://marcasyfranquicias.org',
    			'id_estrategia' => '1',
                'id_admin' => '1',
    			'estatus' => 1,
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
    	);

    	Clientes::insert($data);
    }
}
