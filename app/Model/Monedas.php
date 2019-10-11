<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\CatalogoServicios;
use Emporio\Model\Servicios;

class Monedas extends Model
{
    protected $table='monedas';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'clave', 'moneda', 'conversion', 'estatus'
    ];

    protected $guarded =[

    ];

    public function CatalogoServicios()
    {
        return $this->belongsTo('Emporio\Model\CatalogoServicios', 'clave', 'moneda');
    }

    public function Servicios()
    {
        return $this->hasMany('Emporio\Model\Servicios', 'clave', 'moneda');
    }
}
