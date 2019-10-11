<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class ServiciosPagos extends Model
{
    protected $table='servicios_pagos';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'monto',
    	'id_servicio',
    	'id_admin',
    	'id_control',
    	'id_egreso'
    ];

    protected $guarded =[

    ];
}
