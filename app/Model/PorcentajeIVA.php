<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class PorcentajeIVA extends Model
{
    protected $table='porcentaje_iva';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'porcentaje_iva',
    ];

    protected $guarded =[

    ];
}
