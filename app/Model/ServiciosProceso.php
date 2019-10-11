<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class ServiciosProceso extends Model
{
    protected $table='servicio_progreso';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'resultado',
    	'estatus',
    	'orden',
        'libera_venta',
        'libera_operativa',
        'libera_gestion',
    	'id_requisitos',
    	'id_servicio',
    	'id_admin'
    ];

    protected $guarded =[
    	'created_at', 'updated_at'

    ];
}
