<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class ServiciosRequisitos extends Model
{
    protected $table='servicio_requisitos';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'orden',
        'libera_venta',
        'libera_operativa',
        'libera_gestion',
    	'id_requisitos',
    	'id_catalogo_servicio'
    ];

    protected $guarded =[

    ];
}
