<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CategoriaEstatus;

class CategoriaEstatusTableSeeder extends Seeder
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
        			'clave' => 'SD',
        			'bitacora' => 'Signos Distintivos',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => '2',
        			'clave' => 'BT',
        			'bitacora' => 'Búsqueda Técnica',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => '3',
        			'clave' => 'INV',
        			'bitacora' => 'Invenciones',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
        		[
                    'id' => '4',
        			'clave' => 'DP',
        			'bitacora' => 'Dictamen Previo',
        			'created_at' => new DateTime,
        			'updated_at' => new DateTime
        		],
                [
                    'id' => '5',
                    'clave' => 'CBAR',
                    'bitacora' => 'Códigos de Barra',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'id' => '6',
                    'clave' => 'RO',
                    'bitacora' => 'Registro de Obras',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'id' => '7',
                    'clave' => 'RD',
                    'bitacora' => 'Reserva de Derechos',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'id' => '8',
                    'clave' => 'JU',
                    'bitacora' => 'Juicios',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
                [
                    'id' => '9',
                    'clave' => 'FRAN',
                    'bitacora' => 'Franquicias',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ],
        	);

        	CategoriaEstatus::insert($data);
    }
}
