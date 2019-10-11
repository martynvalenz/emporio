<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Services;

class ServicesTableSeeder extends Seeder
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
    			'servicio' => 'Registro o Renovación de Marca',
    			'slug' => 'registro-o-renovacion-de-marca',
                'id_category' => '2',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Registro o Renovación de Eslogan',
    			'slug' => 'registro-o-renovacion-de-slogan',
                'id_category' => '2',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Publicación o Renovación de Nombre Comercial',
    			'slug' => 'publicacion-o-renovacion-de-nombre-comercial',
                'id_category' => '2',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Registro de Marca Internacional',
    			'slug' => 'registro-de-marca-internacional',
                'id_category' => '2',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Diagnóstico',
    			'slug' => 'diagnostico',
                'id_category' => '3',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Desarrollo',
    			'slug' => 'desarrollo',
                'id_category' => '3',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Representación Legal',
    			'slug' => 'representacion-legal',
                'id_category' => '3',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Representación Comercial',
    			'slug' => 'representacion-comercial',
                'id_category' => '3',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Registro de Obras',
    			'slug' => 'registro-de-obras',
                'id_category' => '5',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Reserva de Derechos',
    			'slug' => 'reserva-de-derechos',
                'id_category' => '5',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Invenciones',
    			'slug' => 'invenciones',
                'id_category' => '6',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Modelo de Utilidad',
    			'slug' => 'modelo-de-utilidad',
                'id_category' => '6',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Diseños Intustriales',
    			'slug' => 'diseños-industriales',
                'id_category' => '6',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Circuitos Integrados',
    			'slug' => 'circuitos-integrados',
                'id_category' => '6',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Auditoría, Medios y Procedimientos para Preservarlos',
    			'slug' => 'auditoria-medios-y-procedimientos-para-preservarlos',
                'id_category' => '7',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Contratos de Confidencialidad',
    			'slug' => 'contratos-de-confidencialidad',
                'id_category' => '7',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Juicios de Infracción, Nulidad, Caducidad, Cancelación y en Materia de Comercio', 
    			'slug' => 'juicios-de-infraccion-nulidad-caducidad-cancelacion-y-en-materia-de-comercio',
                'id_category' => '8',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Medidas Provisionales en Frontera de Tránsito o Transbordo',
    			'slug' => 'medidas-provisionales-en-frontera-de-transito-o-transbordo',
                'id_category' => '8',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Competencia Desleal',
    			'slug' => 'competencia-desleal',
                'id_category' => '8',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Visitas de Inspección',
    			'slug' => 'visitas-de-inspeccion',
                'id_category' => '8',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Confidencialidad',
    			'slug' => 'confidencialidad',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Transferencia de Tecnología',
    			'slug' => 'transferencia-de-tecnologia',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Licencia de Uso',
    			'slug' => 'licencia-de-uso',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Cesión de Derechos',
    			'slug' => 'cesion-de-derechos',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Franquicia',
    			'slug' => 'franquicia',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'servicio' => 'Representación o Distribución',
    			'slug' => 'representacion-o-distribucion',
                'id_category' => '10',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		]
    	);

    	Services::insert($data);
    }
}
