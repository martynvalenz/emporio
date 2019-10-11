<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CategoryServices;

class CategoryServicesTableSeeder extends Seeder
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
    			'categoria' => 'DIAGNÓSTICO DE PROPIEDAD INTELECTUAL',
    			'slug' => 'diagnostico-de-propiedad-intelectual',
                'icon' => 'fas fa-search',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
            [
                'id' => '2',
                'categoria' => 'REGISTRO DE MARCAS',
                'slug' => 'registro-de-marcas',
                'icon' => 'far fa-registered',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '3',
                'categoria' => 'FRANQUICIAS',
                'slug' => 'franquicias',
                'icon' => 'fas fa-university',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '4',
                'categoria' => 'TIENDA DE FRANQUICIAS Y NEGOCIOS',
                'slug' => 'tienda-de-franquicias-y-negocios',
                'icon' => 'fas fa-store-alt',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '5',
                'categoria' => 'DERECHOS DE AUTOR',
                'slug' => 'derechos-de-autor',
                'icon' => 'fas fa-copyright',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '6',
                'categoria' => 'PATENTES',
                'slug' => 'patentes',
                'icon' => 'fas fa-industry',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '7',
                'categoria' => 'PROTECCIÓN DE SECRETOS INDUSTRIALES',
                'slug' => 'proteccion-de-secretos-industriales',
                'icon' => 'fas fa-shield-alt',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '8',
                'categoria' => 'LITIGIOS DE PROPIEDAD INTELECTUAL',
                'slug' => 'litigios-de-propiedad-intelectual',
                'icon' => 'fas fa-gavel',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '9',
                'categoria' => 'CONSTITUCIÓN DE SOCIEDADES',
                'slug' => 'constitucion-de-sociedades',
                'icon' => 'fas fa-users',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '10',
                'categoria' => 'CONTRATOS',
                'slug' => 'contratos',
                'icon' => 'fas fa-file-alt',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '11',
                'categoria' => 'CÓDIGO DE BARRAS',
                'slug' => 'codigo-de-barras',
                'icon' => 'fas fa-barcode',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => '12',
                'categoria' => 'AVISO DE PRIVACIDAD',
                'slug' => 'aviso-de-privacidad',
                'icon' => 'fas fa-hand-paper',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ]
    	);

    	CategoryServices::insert($data);
    }
}
