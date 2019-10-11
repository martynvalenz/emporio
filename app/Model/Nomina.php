<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Servicios;
use Emporio\User;
use Emporio\Model\EstadosCuenta;

class Nomina extends Model
{
    protected $table='nomina';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'fecha_comision',
    	'fecha_pagado',
    	'fecha_aplicada',
        'concepto',
    	'comentarios',
    	'monto',
    	'listo_comision',
    	'comision_aplicada',
    	'pagado',
    	'id_egreso',
    	'id_servicio',
    	'id_admin',
    	
    ];

    protected $dates=[
        'created_at', 'updated_at', 'fecha_comision', 'fecha_pagado', 'fecha_aplicada'
    ];

    protected $guarded =[

    ];

    public function Servicios()
    {
        return $this->belongsTo('Emporio\Model\Servicios', 'id', 'id_servicio');
    }

    public function Admin()
    {
        return $this->belongsTo('Emporio\User', 'id_admin', 'id');
    }
    public function EstadosCuenta()
    {
        return $this->belongsTo('Emporio\Model\EstadosCuenta', 'id', 'id_servicio');
    }
}
